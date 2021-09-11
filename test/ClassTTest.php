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

    public function testClassComment()
    {
        $class = new ClassT('Test');
        $class->classComment('@property string $goodsName');
        $class->classComment('@property string $goodsName');
        echo $class;
    }
}