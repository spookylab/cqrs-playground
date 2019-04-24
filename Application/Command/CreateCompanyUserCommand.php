<?php

namespace CqrsPlayground\Application\Command;

use CqrsPlayground\Domain\ValueObject\Email;
use CqrsPlayground\Domain\ValueObject\Name;
use CqrsPlayground\Domain\ValueObject\Phone;
use Prooph\Common\Messaging\Command;

class CreateCompanyUserCommand extends Command
{
    private $name;
    private $email;
    private $phone;

    public function __construct(Name $name, Email $email, Phone $phone = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;

        $this->init();
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPhone(): ?Phone
    {
        return $this->phone;
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    protected function setPayload(array $payload): void
    {
        $this->name = $payload['name'];
        $this->email = $payload['email'];
        $this->phone = $payload['phone'];
    }
}
