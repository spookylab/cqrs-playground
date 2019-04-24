<?php

namespace CqrsPlayground\Domain\ValueObject;

use CqrsPlayground\Domain\ValueObjectInterface;

class Name implements ValueObjectInterface
{
    private $name;

    public function __construct(string $name)
    {
        if (mb_strlen($name) > 55) {
            throw new \InvalidArgumentException('Name is too long');
        }

        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}
