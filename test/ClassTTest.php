<?php

declare(strict_types=1);


namespace test;


use src\ClassT;

class ClassTTest extends \PHPUnit\Framework\TestCase
{
    public function testClass()
    {
        $class = new ClassT('Test');
        echo $class;
    }
}