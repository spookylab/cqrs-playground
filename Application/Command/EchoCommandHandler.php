<?php

namespace CqrsPlayground\Application\Command;

use Phalcon\Http\Request;
use Phalcon\Db\Adapter\Pdo\Mysql as MysqlAdapter;

class EchoCommandHandler
{
    private $request;
    private $db;

    public function __construct(Request $request, MysqlAdapter $db)
    {
        $this->request = $request;
        $this->db = $db;
    }

    public function __invoke(EchoCommand $command)
    {
        echo $command->getText();
    }
}
