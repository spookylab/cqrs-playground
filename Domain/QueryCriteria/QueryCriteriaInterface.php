<?php

namespace CqrsPlayground\Domain\QueryCriteria;

interface QueryCriteriaInterface
{
    public function getCondition(): string;
}