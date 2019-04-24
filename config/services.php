<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use Prooph\ServiceBus\CommandBus;
use Prooph\ServiceBus\QueryBus;
use Prooph\ServiceBus\Plugin\Router\CommandRouter;
use Prooph\ServiceBus\Plugin\Router\QueryRouter;
use CqrsPlayground\Infrastructure\DependencyResolver;

$di->setShared('config', function () use ($config) {
    return $config;
});

$di->setShared('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('CqrsPlayground\Presentation\Controllers');

    return $dispatcher;
});

$di->setShared('db', function () {
    $config = $this->getConfig();
    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    
    return new $class((array) $config->database);
});

$di->set('view', function () {
    $view = new View();
    $view->setViewsDir(APP_BASE_PATH . '/Presentation/views');
    $view->registerEngines([
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
    ]);

    return $view;
});

$di->setShared('eventsManager', function () {
    return new EventsManager();
});

$di->setShared('commandBus', function () {
    $commandBus = new CommandBus();
    $commandRouter = new CommandRouter();
    $dependencyResolver = new DependencyResolver($this);

    $config = $this->getConfig();
    foreach ($config->commands as $commandName => $commandHandler) {
        $commandRouter
            ->route($commandName)
            ->to(
                is_callable($commandHandler)
                    ? $commandHandler
                    : $dependencyResolver->autowire($commandHandler)
            );
    }

    $commandRouter->attachToMessageBus($commandBus);

    return $commandBus;
});

$di->setShared('queryBus', function () {
    $queryBus = new QueryBus();
    $queryRouter = new QueryRouter();
    $dependencyResolver = new DependencyResolver($this);

    $config = $this->getConfig();
    foreach ($config->queries as $queryName => $queryHandler) {
        $queryRouter
            ->route($queryName)
            ->to(
                is_callable($queryHandler)
                    ? $queryHandler
                    : $dependencyResolver->autowire($queryHandler)
            );
    }

    $queryRouter->attachToMessageBus($queryBus);

    return $queryBus;
});
