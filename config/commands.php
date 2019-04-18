<?php

use Phalcon\Config;

use CqrsPlayground\Application\Command\EchoCommand;
use CqrsPlayground\Application\Command\EchoCommandHandler;

return new Config([
    'commands' => [
        EchoCommand::class => EchoCommandHandler::class,
    ],
]);
