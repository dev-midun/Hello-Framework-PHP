<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

class Home extends Controller {

    public function __construct() {
        $this->auth();
        $this->auth->alreadyLogin();
        $this->model('Home');
    }

    /**
     * Method index
     * Default Main Method
     */
    public function index() {
        // $config = (object)array(
        //     'js' => array(
        //         (object)array(
        //             'src' => ADMIN_LTE. 'dist/js/pages/dashboard.js'
        //         ),
        //         (object)array(
        //             'src' => ADMIN_LTE. 'dist/js/demo.js'
        //         )
        //     )
        // );

        $this->template('HelloWorld/starter');
    }

}