<?php

use Phalcon\Config;

defined('APP_ENV') or define('APP_ENV', getenv('APP_ENV'));
defined('APP_PUBLIC_PATH') or define('APP_PUBLIC_PATH', realpath(__DIR__ . '/../public'));
defined('APP_BASE_PATH') or define('APP_BASE_PATH', realpath(__DIR__ . '/..'));
defined('APP_SRC_PATH') or define('APP_SRC_PATH', APP_BASE_PATH . '/app');

include APP_BASE_PATH . '/vendor/autoload.php';

$config = new Config([
    'version' => '1.0.0',
    'database' => [
        'adapter' => 'Mysql',
        'host' => '172.17.0.3',
        'port' => 3306,
        'username' => 'cqrs_playground',
        'password' => 'cqrs_playground',
        'dbname' => 'cqrs_playground',
        'charset' => 'utf8',
    ],
]);

$config->merge(include __DIR__ . '/commands.php');
$config->merge(include __DIR__ . '/queries.php');
$config->merge(include __DIR__ . '/env/' . APP_ENV . '.php');

return $config;
