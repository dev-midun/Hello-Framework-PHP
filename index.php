<?php

define('BASE_PATH', true);
define('ACCESS_DENIED', json_encode(array('success' => false, 'message' => 'Access Denied'), JSON_PRETTY_PRINT));
define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

/**
 * Const ENVIRONMENT
 * By Default: DEV, DEV-LIVE, PROD
 * DEV      => Local only
 * DEV-LIVE => Development in cloud/host
 * PROD     => Golive / production
 */
define('ENVIRONMENT', "DEV");

session_start();

/** Change it your default timezone is different */
date_default_timezone_set('Asia/Jakarta');

require_once __DIR__. '/vendor/autoload.php';
require_once __DIR__. '/app/configuration/config.php';
require_once __DIR__. '/app/core/Controller.core.php';
require_once __DIR__. '/app/core/Database.core.php';
require_once __DIR__. '/app/core/Auth.core.php';
require_once __DIR__. '/app/core/HTTPClient.core.php';
require_once __DIR__. '/app/core/Migrate.core.php';
require_once __DIR__. '/app/core/Template.core.php';
require_once __DIR__. '/app/core/Request.core.php';
require_once __DIR__. '/app/configuration/router.php';