<?php

namespace CqrsPlayground\Domain\ValueObject;

use CqrsPlayground\Domain\ValueObjectInterface;

class Email implements ValueObjectInterface
{
    private $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email is not valid');
        }
        if (mb_strlen($email) > 255) {
            throw new \InvalidArgumentException('Email is too long');
        }

        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}
