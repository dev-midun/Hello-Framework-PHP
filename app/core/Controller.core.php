<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Ramsey\Uuid\Uuid;

class Controller {

    protected $auth;
    protected $template;

    /**
     * Method auth
     * Load and access auth in Controller
     */
    final protected function auth($useJWT = true) {
        $this->auth = new Auth($useJWT);
    }

    /**
     * Method model
     * Load and access model in Controller
     * @param {string|array} name Model Name
     *      name {string} CategoryModel
     *      name {array} with alias: [
     *          'model' => 'alias',
     *          ...
     *      ]
     *      name {array} witout alias: [
     *          'model1', ...
     *      ]
     * @param {string} alias
     */
    final protected function model($name, $alias = '') {
        $this->loadModule('model', $name, $alias);
    }

    /**
     * Method helper
     * Load and access helper in Controller
     * @param {string|array} name Helper Name
     *      name {string} Form
     *      name {array} with alias: [
     *          'helper' => 'alias',
     *          ...
     *      ]
     *      name {array} witout alias: [
     *          'helper1', ...
     *      ]
     * @param {string} alias
     * @param {array} constructArgument
     */
    final protected function helper($name, $alias = '', $constructArgument = array()) {
        $this->loadModule('helper', $name, $alias, $constructArgument);
    }

    /**
     * Method library
     * Load and access Library in Controller
     * @param {string|array} name Library Name
     *      name {string} CustomLibrary
     *      name {array} with alias: [
     *          'library' => 'alias',
     *          ...
     *      ]
     *      name {array} witout alias: [
     *          'library1', ...
     *      ]
     * @param {string} alias
     */
    final protected function library($name, $alias = '') {
        $this->loadModule('library', $name, $alias);
    } 

    /**
     * Method view
     * Load and render single view
     * @param {string} name ViewName or ViewFolder/ViewName or ViewFolder/ViewFolder/ViewName or multi sub folder is support
     * @param {array} data parsing data to variable with the name of variable use key array
     * @param {boolean} return make view return as variable or echo the result to client
     */
    final public function view($name, $data = null, $return = false) {
        $temp = explode('/', $name);
			
        $viewPath = '';
        for($i=0; $i<count($temp); $i++){
            if((count($temp)-$i != 1)) {
                $viewPath .= $temp[$i].DS;
            }
            else {
                $viewPath .= $temp[$i];
            }
        }
        
        ob_start();
        if(!empty($data)) {
            foreach($data as $key => $value) {
                ${$key} = $value;
            }
        }
        require_once VIEW.$viewPath. '.php';
        $view = ob_get_contents();
        ob_end_clean();

        if($return) {
            return $view;
        }

        echo $view;
        die();
    }

    /**
     * Method template
     * Load and render content to template AdminLTE
     * @param {string} content path content in folder view
     * @param {object} config default null
     *                  conifg.css {array}
     *                  config.js {array of object}
     *                      js.src {string}
     *                      js.type {string} if empty or not isset, default is script js basic
     * @param {array} data default null, parsing var to content
     */
    final protected function template($content, $config = null, $data = null) {
        $this->template = new Template();
        
        $this->template->layout($content, $config, $data);
    }

    /**
     * Method sendEmail
     * @param {string / array} to
     *              to {string}
     *              to {array} [
     *                  'to' => '', || 'to' => ['', '', ...] || 'to' => ['name' => 'email', ...]
     *                  'cc' => '', || 'cc' => ['', '', ...] || 'cc' => ['name' => 'email', ...]
     *              ]
     * @param {string} subject
     * @param {string} message
     * @param {array} attachment
     * @param {boolean} isHTML
     * @return {object} result
     *              result.success {boolean}
     *              result.message {string}
     */
    final public function sendEmail($to, $subject, $message, $attchment = null, $isHTML = false) {
        $result = (Object)array(
            'success' => false,
            'message' => ''
        );

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug  = SMTP::DEBUG_OFF; 
            $mail->isSMTP();
            $mail->Host       = HOST_EMAIL;
            $mail->SMTPAuth   = true;
            $mail->Username   = USERNAME_EMAIL;
            $mail->Password   = PASSWORD_EMAIL;
            $mail->SMTPSecure = strtolower(SMTP_SECURE_EMAIL) == 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = PORT_EMAIL;

            $mail->setFrom(USERNAME_EMAIL, NAME_EMAIL);
            
            // Set To
            if(is_array($to) && isset($to['to'])) {
                if(is_array($to['to']) && count($to['to']) > 0) {
                    foreach($to['to'] as $nameTo => $emailTo) {
                        if(is_string($nameTo)) {
                            $mail->addAddress($emailTo, $nameTo);
                        }
                        else {
                            $mail->addAddress($emailTo);
                        }
                    }
                }
                else {
                    $mail->addAddress($to['to']);
                }
            }
            else {
                $mail->addAddress($to);
            }

            // Set CC
            if(is_array($to) && isset($to['cc'])) {
                if(is_array($to['cc']) && count($to['cc']) > 0) {
                    foreach($to['cc'] as $nameCC => $emailCC) {
                        if(is_string($nameCC)) {
                            $mail->addCC($nameCC, $emailCC);
                        }
                        else {
                            $mail->addCC($emailCC);
                        }
                    }
                }
                else {
                    $mail->addCC($to['cc']);
                }
            }

            $mail->isHTML($isHTML);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            $result->success = true;
        } 
        catch (Exception $e) {
            $result->message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return $result;
    }

    /**
     * Method responseJSON
     * Return response to JSON
     * @param {any} data can be string, int, object, array or any
     * @param {int} responseCode
     */
    final public function responseJSON($data, $responseCode = 200) {
        http_response_code($responseCode);
        header("Content-Type: application/json");
        header("Accept: application/json");

        echo json_encode($data, JSON_PRETTY_PRINT);
        die();
    }

    /**
     * Method responseError
     * Render view to error page or return response with error message in json
     * @param {int} errorCode
     * @param {string} message
     * @param {boolean} json default is false
     */
    final public function responseError($errorCode, $message, $json = false) {
        http_response_code($errorCode);
        if($json) {
            header("Content-Type: application/json");
            header("Accept: application/json");
            echo json_encode(array(
                'success' => false,
                'message' => $message
            ), JSON_PRETTY_PRINT);

            die();
        }
        
        $this->view('error/error', array(
            'error' => $errorCode,
            'message' => $message
        ));
    }

    /**
     * Method redirect
     * Redirect page to another url
     * @param {string} url default is SITE_URL
     */
    final public function redirect($url = SITE_URL){
        header("Location: {$url}");
        die();
    }

    /**
     * Method loadModule
     * Load Module Model, Helper, and Library and access it to controller
     * @param {string} type model, library, and helper
     * @param {string || array} name
     * @param {string} alias
     * @param {array} constructArgument
     */
    private function loadModule($type, $name, $alias, $constructArgument = array()) {
        $dir = array();
        switch (strtolower($type)) {
            case 'model':
                $dir[0] = MODEL;
                $dir[1] = '.model.php';
                break;

            case 'helper':
                $dir[0] = HELPER;
                $dir[1] = '.helper.php';
                break;
            
            case 'library':
                $dir[0] = LIBRARY;
                $dir[1] = '.library.php';
                break;

            default:
                break;
        }

        if(is_array($name) && !empty($name)) {
            foreach($name as $key => $value) {
                require_once $dir[0].$value.$dir[1];
                
                $temp = strtolower($type) == 'model' ? $value. 'Model' : $value;
                if(is_string($key)) {
                    $this->$key = new $temp(...$constructArgument);
                }
                else {
                    $this->$value = new $temp(...$constructArgument);
                }
            }
        }
        else {
            require_once $dir[0].$name.$dir[1];

            $temp = strtolower($type) == 'model' ? $name. 'Model' : $name;
            if(!empty($alias)) {
                $this->$alias = new $temp(...$constructArgument);
            }
            else {
                $this->$name = new $temp(...$constructArgument);
            }
        }
    }

    /**
     * Method NewGuid
     * Generate New Guid
     * @param {string} type. Default is string. byte | string
     * @return {byte | string} guid
     */
    final protected function NewGuid($type = 'string') {
        $uuid = Uuid::uuid4();

        return ($type == 'byte') ? $uuid->getBytes() : (($type == 'string') ? $uuid->toString() : null);
    }

    /**
     * Method ParseGuid
     * Generate Guid from string
     * @param {string} guidString
     * @param {string} type. Default is string. byte | string
     * @return {byte | string} guid
     */
    final protected function ParseGuid($guidString, $type = 'string') {
        $uuid = Uuid::fromString($guidString);

        return ($type == 'byte') ? $uuid->getBytes() : (($type == 'string') ? $uuid->toString() : null);
    }

    /**
     * Method ToStringGuid
     * Guid to String
     * @param {byte | string} guid
     * @param {string} type. Default is string. byte | string
     */
    final protected function ToStringGuid($guid, $type = 'string') {
        $uuid = ($type == 'byte') ? Uuid::fromBytes($guid) : Uuid::fromString($guidString);

        return $uuid->toString();
    }

    /**
     * Method consoleLog
     * Beautify var dump
     * @param {any} data
     */
    final public function consoleLog($data) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        // echo '<pre>' . var_export($data, true) . '</pre>';

        /*highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");*/

        die();
    }
}