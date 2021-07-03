<?php

namespace App\Services\Number\Domain\ValueObject;

class Country
{

    public function __construct($name, $code, $matchExpression)
    {
        $this->name = $name;
        $this->code = $code;
        $this->matchExpression = $matchExpression;
    }

    private string $name;

    private int $code;

    private string $matchExpression;

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMatchExpression()
    {
        return $this->matchExpression;
    }
}
