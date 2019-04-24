<?php

use Phalcon\Config;

use CqrsPlayground\Application\Command\EchoCommand;
use CqrsPlayground\Application\Command\EchoCommandHandler;
use CqrsPlayground\Application\Command\CreateCompanyUserCommand;
use CqrsPlayground\Application\Command\CreateCompanyUserCommandHandler;

return new Config([
    'commands' => [
        EchoCommand::class => EchoCommandHandler::class,
        CreateCompanyUserCommand::class => CreateCompanyUserCommandHandler::class,
    ],
]);
