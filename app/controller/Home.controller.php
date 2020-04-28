<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

class Home extends Controller {
    
    private $isCanAccess;
    
    public function __construct() {
        $this->auth();
        $this->auth->alreadyLogin();
        $this->isCanAccess = $this->auth->isCanAccess('Home');
        $this->model('Home');
    }

    /**
     * Method index
     * Default Main Method
     */
    public function index() {
        if(!$this->isCanAccess || !$this->isCanAccess->isCanRead) {
            $this->responseError(403, 'Access Denied');
        }

        $config = (object)array(
            'js' => array(
                (object)array(
                    'src' => ADMIN_LTE. 'dist/js/pages/dashboard.js'
                ),
                (object)array(
                    'src' => ADMIN_LTE. 'dist/js/demo.js'
                )
            )
        );

        $this->template('HelloWorld/starter');
    }

}