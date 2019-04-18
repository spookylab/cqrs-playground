<?php

namespace CqrsPlayground\Presentation\Controllers;

use Phalcon\Mvc\Controller as BaseController;
use CqrsPlayground\Application\Command\EchoCommand;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $echoCommand = new EchoCommand('some test string');
        
        $this->commandBus->dispatch($echoCommand);
    }
}
