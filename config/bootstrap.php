<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

$di = new FactoryDefault();

$config = include 'config.php';

include 'services.php';

echo (new Application($di))->handle()->getContent();
