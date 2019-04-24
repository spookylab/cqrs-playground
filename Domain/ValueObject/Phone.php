<?php

namespace CqrsPlayground\Domain\ValueObject;

use CqrsPlayground\Domain\ValueObjectInterface;

class Phone implements ValueObjectInterface
{
    private $phone;

    public function __construct(string $phone)
    {
        if (!preg_match('/^\+\d{11}$/', $phone)) {
            throw new \InvalidArgumentException('Phone is not compliant with required format: +00000000000');
        }

        $this->phone = $phone;
    }

    public function value(): string
    {
        return $this->phone;
    }
}
