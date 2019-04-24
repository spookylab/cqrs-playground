<?php

namespace CqrsPlayground\Application\Query;

use CqrsPlayground\Application\Models\CompanyUsers;
use Phalcon\Mvc\Model\Manager as ModelManager;
use React\Promise\Deferred;

class GetCompanyUsersQueryHandler
{
    /** @var ModelManager */
    private $modelsManager;

    public function __construct(ModelManager $modelsManager)
    {
        $this->modelsManager = $modelsManager;
    }

    public function __invoke(GetCompanyUsersQuery $query, Deferred $deferred)
    {
        try {
            $results = $this->modelsManager->createBuilder()
                ->limit($query->getLimit(), $query->getOffset())
                ->from(CompanyUsers::class)
                ->getQuery()
                ->execute();

            $deferred->resolve($results);
        } catch (\Exception $exception) {
            $deferred->reject($exception);
        }
    }
}
