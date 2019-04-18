<?php

error_reporting(E_ALL);

define('APP_ENV', getenv('APP_ENV'));
define('APP_PUBLIC_PATH', __DIR__);
define('APP_BASE_PATH', dirname(__DIR__));

$bootstrap = 'bootstrap';

if (isset($_SERVER['APP_ENV'])) {
    $bootstrap .= '.dev';
}

require APP_BASE_PATH . "/config/$bootstrap.php";
