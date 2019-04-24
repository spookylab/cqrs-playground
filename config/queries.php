<?php

use Phalcon\Config;

use CqrsPlayground\Application\Query\GetCompanyUsersQuery;
use CqrsPlayground\Application\Query\GetCompanyUsersQueryHandler;

return new Config([
    'queries' => [
        GetCompanyUsersQuery::class => GetCompanyUsersQueryHandler::class,
    ],
]);
