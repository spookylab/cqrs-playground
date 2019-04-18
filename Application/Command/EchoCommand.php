<?php

namespace CqrsPlayground\Application\Command;

use Prooph\Common\Messaging\Command;

class EchoCommand extends Command
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->init();
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function payload(): array
    {
        return ['text' => $this->text];
    }

    protected function setPayload(array $payload): void
    {
        $this->text = $payload['text'];
    }
}
