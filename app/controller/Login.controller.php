<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

class Login extends Controller {

    public function __construct() {
        $this->auth();
        $this->model('User');
    }

    /**
     * Method index
     */
    public function index() {
        if($this->auth->isLogin()) {
            $this->redirect();
        }

        $this->view('Auth/login');
    }

    /**
     * Method doLogin
     */
    public function doLogin() {
        $result = (object)array(
            'success' => false,
            'message' => '',
            'errorList' => [
                'username' => '', 
                'password' => ''
            ]
        );
        $check = true;
        $isError = true;
        $statusCode = 200;
        $messageDefault = (object)array(
            'required' => [
                'username' => 'Username is required',
                'password' => 'Password is required'
            ],
            'wrong' => [
                'username' => 'Username is wrong',
                'password' => 'Password is wrong'
            ]
        );

        try {
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data) && !empty($data)) {
                if(!isset($data->username) || empty($data->username)) {
                    $result->errorList['username'] = $messageDefault->required['username'];
                    $check = false;
                }

                if(!isset($data->password) || empty($data->password)) {
                    $result->errorList['password'] = $messageDefault->required['password'];
                    $check = false;
                }
            }
            else {
                $isError = false;
                throw new Exception('Please check parameter');
            }

            if(!$check) {
                $isError = false;
                $result->errorList['username'] = $messageDefault->wrong['username'];
                $result->errorList['password'] = $messageDefault->wrong['password'];

                throw new Exception('Username or Password is wrong');
            }

            // get user data
            $userData = $this->User->getUserData($data->username);
            if(!$userData->success) {
                throw new Exception($userData->message);
            }

            if(!password_verify($data->password, $userData->data[0]['password'])) {
                $isError = false;
                $result->errorList['username'] = $messageDefault->wrong['username'];
                $result->errorList['password'] = $messageDefault->wrong['password'];

                throw new Exception('Username or Password is wrong');
			}

            if(USE_JWT) {
                $this->setCookies($userData->data[0]);
            }
            else {
                $this->setSession($userData->data[0]);
            }

            $result->success = true;
        } 
        catch (Exception $e) {
            if($isError) {
                $statusCode = 400;
            }
            $result->message = $e->getMessage();
        }

        $this->responseJSON($result, $statusCode);
    }

    /**
     * 
     */
    private function setSession($userData) {

    }

    /**
     * 
     */
    private function setCookies($userData) {
        $jwtToken = $this->auth->buildJWT($userData['username'], 7200);
        setcookie(QUERY_STRING_AUTH, $jwtToken, (time() + 7200), '/');

        $this->setAccessRight($userData['username']);
    }

    /**
     * 
     */
    private function setAccessRight($username) {
        $accessData = $this->User->getAccessList($username);
        if($accessData->success) {
            $tempAccessList = array();
            $tempSidebar = array();
            foreach($accessData->data as $access) {
                $tempAccessList[$access['name']] = (object)array(
                    'isCanRead' => intval($access['isCanRead']) == 0 ? false : true,
                    'isCanInsert' => intval($access['isCanInsert']) == 0 ? false : true,
                    'isCanUpdate' => intval($access['isCanUpdate']) == 0 ? false : true,
                    'isCanDelete' =>  intval($access['isCanDelete']) == 0 ? false : true
                );

                $tempSidebar[] = (object)array(
                    'title' => $access['name'],
                    'icon' => $access['icon'],
                    'router' => $access['router']
                );
            }
            $_SESSION['sess_access_list'] = $tempAccessList;
            $_SESSION['sess_sidebar'] = $tempSidebar;
        }
    }

    /**
     * 
     */
    public function logout() {
		session_unset();
        session_destroy();
        
        if(USE_JWT) {
            unset($_COOKIE[QUERY_STRING_AUTH]);
            setcookie(QUERY_STRING_AUTH, '', (time() - 3600), '/');
        }

		$this->redirect(SITE_URL. 'login');
	}
}