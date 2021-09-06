<?php

declare(strict_types=1);


namespace src;


class NamespaceT
{
    protected $namespace;

    public function __construct($namespace)
    {
        $this->namespace = 'namespace ' . $namespace . ';' . PHP_EOL;
    }

    public function __toString()
    {
        return $this->namespace;
    }
}