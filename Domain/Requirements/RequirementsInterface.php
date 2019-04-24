<?php

namespace CqrsPlayground\Domain\Requirements;

interface RequirementsInterface
{
    public function areFulfilled(): bool;
}