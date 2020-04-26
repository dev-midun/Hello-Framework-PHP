<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

class Request {
    
    public function __construct() {
        if(CORS_SUPPORT) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Content-Disposition, Accept, Access-Control-Request-Method');
            header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, PATCH, DELETE');
            header("Access-Control-Max-Age: 3600");
        }
    }

    /**
     * Method call
     * get and call controller based by controller name and method name
     * @param {string} request ControllerName/MethodName
     * @param {array} data
     * @param {boolean} caseSensitive Get Controller and Method Name by case sensitive
     */
    public function call($request = "", $data = array(), $caseSensitive = false) {
        $uri = explode('/', $request);

        if($caseSensitive) {
            $class = (isset($uri[0]) && (!empty($uri[0]))) ? $uri[0] : ucfirst(DEFAULT_CONTROLLER);
            $method = isset($uri[1]) ? $uri[1] : 'index';

            $controller = CONTROLLER.$class. '.controller.php';
        }
        else {
            $class = (isset($uri[0]) && (!empty($uri[0]))) ? ucfirst(strtolower($uri[0])) : ucfirst(DEFAULT_CONTROLLER);
            $method = isset($uri[1]) ? strtolower($uri[1]) : 'index';

            $controller = CONTROLLER.ucfirst(strtolower($class)). '.controller.php';
        }

        try {
            if(file_exists($controller)) {
                require_once $controller;
                $object = new $class();
    
                if(method_exists($object, $method)) {
                    call_user_func_array(array($object, $method), $data);
                }
            }
            else {
                $this->error(400);
            }
        } 
        catch (Exception $e) {
            $this->error(500, $e->getMessage(). '\n' .$e->getTraceAsString());
        }
    }

    /**
     * Method error
     * Render / return message response error when doing request in router side
     * @param {int} errorCode
     * @param {string} customMessage default string empty
     * @param {boolean} jsonOutput default false
     */
    public function error($errorCode = 404, $customMessage = '', $jsonOutput = false) {        
        $controller = new Controller();

        $message = '';
        switch ($errorCode) {
            case 405:
                $message = empty(trim($customMessage)) ? 'Method Not Allowed' : $customMessage;
                break;
            case 500:
                $message = empty(trim($customMessage)) ? 'Internal Server Error' : $customMessage;
                break;
            case 404:
            default:
                $message = empty(trim($customMessage)) ? 'Not Found' : $customMessage;
                break;
        }

        $data = (object)array(
            'error' => $errorCode,
            'message' => $message
        );

        if($jsonOutput) {
            header("Content-Type: application/json");
            return $data;
        }

        return $controller->view('error/error', $data, true);
    }
}