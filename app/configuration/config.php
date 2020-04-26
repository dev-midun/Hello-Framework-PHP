<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

/** Configuration URL */
    $__configuration['BASE_URL'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => 'http://localhost/Others/Hello-Framework-PHP/'
    );
    $__configuration['SITE_URL'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => 'http://localhost:8000/'
    );
    $__configuration['CONTROLLER'] = ROOT.DS. 'app' .DS. 'controller' .DS;
    $__configuration['MODEL'] = ROOT.DS. 'app' .DS. 'model' .DS;
    $__configuration['VIEW'] = ROOT.DS. 'app' .DS. 'view' .DS;
    $__configuration['HELPER'] = ROOT.DS. 'app' .DS. 'helper' .DS;
    $__configuration['LIBRARY'] = ROOT.DS. 'app' .DS. 'library' .DS;
    $__configuration['ASSETS'] = $__configuration['BASE_URL'][ENVIRONMENT]. 'assets/';
    $__configuration['ADMIN_LTE'] = $__configuration['BASE_URL'][ENVIRONMENT]. 'vendor/almasaeed2010/adminlte/';
/** End Configuration URL */

/** Default Controller  */
    $__configuration['DEFAULT_CONTROLLER'] = array(
        'PROD' => 'home',
        'DEV-LIVE' => 'home',
        'DEV' => 'home'
    );
/** End Default Controller  */

/** Use JWT & Key Auth for Secret Key JWT */
    $__configuration['USE_JWT'] = true;
    $__configuration['KEY_AUTH'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => '5955b79bfe79491f4759b213bf392274'
    );
    $__configuration['QUERY_STRING_AUTH'] = 'access_key';
/** End Key Auth for Secret Key JWT */

/** Pusher Realtime */
    $__configuration['PUSHER_APP_ID'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => '965857'
    );
    $__configuration['PUSHER_KEY'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => '48ed041a3c047eb45efc'
    );
    $__configuration['PUSHER_SECRET'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => '05f22616e5e1f5f66e06'
    );
    $__configuration['PUSHER_CLUSTER'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => 'ap1'
    );
/** End Pusher Realtime */

/** CORS Support */
    $__configuration['CORS_SUPPORT'] = array(
        'PROD' => true,
        'DEV-LIVE' => true,
        'DEV' => true
    );
/** End CORS Support */

/** Email Configuration */
    $__configuration['HOST_EMAIL'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => ''
    );
    $__configuration['NAME_EMAIL'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => ''
    );
    $__configuration['USERNAME_EMAIL'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => ''
    );
    $__configuration['PASSWORD_EMAIL'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => ''
    );
    $__configuration['PORT_EMAIL'] = array(
        'PROD' => 465,
        'DEV-LIVE' => 465,
        'DEV' => 465
    );
    $__configuration['SMTP_SECURE_EMAIL'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => ''
    ); // tls or ssl
/** End Email Configuration */

/** Database Configuration */
    $__configuration['USE_SQL_BUILDER'] = array(
        'PROD' => true,
        'DEV-LIVE' => true,
        'DEV' => true
    );
    $__configuration['DB_HOST'] = array(
        'PROD' => 'localhost',
        'DEV-LIVE' => 'localhost',
        'DEV' => 'localhost'
    );
    $__configuration['DB_USERNAME'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => 'root'
    );
    $__configuration['DB_PASSWORD'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => ''
    );
    $__configuration['DB_NAME'] = array(
        'PROD' => '',
        'DEV-LIVE' => '',
        'DEV' => 'dev-sob'
    );
/** End Database Configuration */

/** DONT CHANGE IT */
    define('BASE_URL', $__configuration['BASE_URL'][ENVIRONMENT]);
    define('SITE_URL', $__configuration['SITE_URL'][ENVIRONMENT]);
    define('CONTROLLER', $__configuration['CONTROLLER']);
    define('MODEL', $__configuration['MODEL']);
    define('VIEW', $__configuration['VIEW']);
    define('HELPER', $__configuration['HELPER']);
    define('LIBRARY', $__configuration['LIBRARY']);
    define('ASSETS', $__configuration['ASSETS']);
    define('ADMIN_LTE', $__configuration['ADMIN_LTE']);
    define('DEFAULT_CONTROLLER', $__configuration['DEFAULT_CONTROLLER'][ENVIRONMENT]);
    define('USE_JWT', $__configuration['USE_JWT']);
    define('KEY_AUTH', $__configuration['KEY_AUTH'][ENVIRONMENT]);
    define('QUERY_STRING_AUTH', $__configuration['QUERY_STRING_AUTH']);
    define('PUSHER_APP_ID', $__configuration['PUSHER_APP_ID'][ENVIRONMENT]);
    define('PUSHER_KEY', $__configuration['PUSHER_KEY'][ENVIRONMENT]);
    define('PUSHER_SECRET', $__configuration['PUSHER_SECRET'][ENVIRONMENT]);
    define('PUSHER_CLUSTER', $__configuration['PUSHER_CLUSTER'][ENVIRONMENT]);
    define('CORS_SUPPORT', $__configuration['CORS_SUPPORT'][ENVIRONMENT]);
    define('HOST_EMAIL', $__configuration['HOST_EMAIL'][ENVIRONMENT]);
    define('NAME_EMAIL', $__configuration['NAME_EMAIL'][ENVIRONMENT]);
    define('USERNAME_EMAIL', $__configuration['USERNAME_EMAIL'][ENVIRONMENT]);
    define('PASSWORD_EMAIL', $__configuration['PASSWORD_EMAIL'][ENVIRONMENT]);
    define('PORT_EMAIL', $__configuration['PORT_EMAIL'][ENVIRONMENT]);
    define('SMTP_SECURE_EMAIL', $__configuration['SMTP_SECURE_EMAIL'][ENVIRONMENT]);
    define('USE_SQL_BUILDER', $__configuration['USE_SQL_BUILDER'][ENVIRONMENT]);
    define('DB_HOST', $__configuration['DB_HOST'][ENVIRONMENT]);
    define('DB_USERNAME', $__configuration['DB_USERNAME'][ENVIRONMENT]);
    define('DB_PASSWORD', $__configuration['DB_PASSWORD'][ENVIRONMENT]);
    define('DB_NAME', $__configuration['DB_NAME'][ENVIRONMENT]);
/** DONT CHANGE IT */

# ========================================================================================= #

/** YOUR CUSTOM CONFIGURATION AND CONSTANTA */
/** YOUR CUSTOM CONFIGURATION AND CONSTANTA */