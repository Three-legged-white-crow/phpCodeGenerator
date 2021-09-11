<?php

declare(strict_types=1);


namespace src;


class ClassT
{
    protected $string;

    public function __construct($className)
    {
        $this->string = 'class ' . $className;
    }

    public function __toString()
    {
        return $this->string . PHP_EOL . "{" . PHP_EOL . "}";
    }
}