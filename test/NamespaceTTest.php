<?php

declare(strict_types=1);

namespace test;

use src\NamespaceT;

class NamespaceTTest extends \PHPUnit\Framework\TestCase
{
    public function testClass()
    {
        $class = new NamespaceT('Test');
        echo $class;
    }
}