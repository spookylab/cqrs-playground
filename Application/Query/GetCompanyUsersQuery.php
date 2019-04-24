<?php

namespace CqrsPlayground\Application\Query;

use Prooph\Common\Messaging\Query;

class GetCompanyUsersQuery extends Query
{
    private $limit;
    private $offset;

    public function __construct(int $limit = 25, int $offset = 0)
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->init();
    }

    public function getLimit(): string
    {
        return $this->limit;
    }

    public function getOffset(): string
    {
        return $this->offset;
    }

    public function payload(): array
    {
        return [
            'limit' => $this->limit,
            'offset' => $this->offset
        ];
    }

    protected function setPayload(array $payload): void
    {
        $this->limit = $payload['limit'];
        $this->offset = $payload['offset'];
    }
}
