<?php

declare(strict_types=1);


namespace test;


use PHPUnit\Framework\TestCase;
use src\NamespaceT;
use src\StartT;

class File extends TestCase
{
    public function testAll()
    {
        $php       = new StartT();
        $namespace = new NamespaceT('Test');
        echo $php . $namespace;
    }
}