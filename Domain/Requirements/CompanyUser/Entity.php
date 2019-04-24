<?php

namespace CqrsPlayground\Domain\Requirements\CompanyUser;

class Entity
{
    private $email;
    private $totalNumber;

    public function __construct(string $email, int $totalNumber)
    {
        $this->email = $email;
        $this->totalNumber = $totalNumber;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getTotalNumber(): int
    {
        return $this->totalNumber;
    }
}