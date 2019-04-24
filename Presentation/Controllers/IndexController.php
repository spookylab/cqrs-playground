<?php

namespace CqrsPlayground\Presentation\Controllers;

use CqrsPlayground\Application\Command\CreateCompanyUserCommand;
use CqrsPlayground\Domain\ValueObject\Email;
use CqrsPlayground\Domain\ValueObject\Name;
use CqrsPlayground\Domain\ValueObject\Phone;
use Phalcon\Events\Event;
use Phalcon\Mvc\Controller as BaseController;
use CqrsPlayground\Application\Query\GetCompanyUsersQuery;
use Phalcon\Mvc\Model\ResultsetInterface;
use React\Promise\Promise;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $view = $this->view;
        $getCompanyUsers = new GetCompanyUsersQuery();

        /** @var Promise $queryPromise */
        $queryPromise = $this->queryBus->dispatch($getCompanyUsers);
        $queryPromise
            ->then(function (ResultsetInterface $resultset) use ($view) {
                $view->numberOfUsers = $resultset->count();
            })
            ->otherwise(function (\Exception $exception) {
                echo "Encountered error: {$exception->getMessage()}";
            })
        ;
    }

    public function createAction()
    {
        $name = $this->request->getQuery('name');
        $email = $this->request->getQuery('email');
        $phone = $this->request->getQuery('phone');

        $createCompanyUser = new CreateCompanyUserCommand(
            new Name($name),
            new Email($email),
            $phone ? new Phone($phone) : null
        );

        $this->getDI()->getShared('eventsManager')
            ->attach('CompanyUser:Created', function (Event $event) {
                var_dump($event->getData());
                die;
            })
        ;
        $this->getDI()->getShared('eventsManager')
            ->attach('CompanyUser:SaveFailed', function (Event $event) {
                var_dump($event->getData());
                die;
            })
        ;

        $this->commandBus->dispatch($createCompanyUser);
    }
}
