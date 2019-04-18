<?php

use Phalcon\Config;

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => '172.17.0.3',
        'port' => 3306,
        'username' => 'cqrs_playground',
        'password' => 'cqrs_playground',
        'dbname' => 'cqrs_playground',
        'charset' => 'utf8',
    ]
]);
