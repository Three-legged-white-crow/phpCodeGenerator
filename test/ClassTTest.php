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
        $class->addClassComment('@property string $goodsName');
        $class->addClassComment('@property string $goodsName');
        echo $class;
    }

    public function testProperty()
    {
        $class = new ClassT('Test');
        $class->addPublicProperty('goods');
        $class->addProtectProperty('pp');
        $class->addClassComment('@property string $goodsName');
        $class->addClassComment('@property string $goodsName');
        echo $class;
    }

    public function testMethod()
    {
        $class = new ClassT('Test', 'Father');
        $class->addUse('Test/add');
        $class->addPublicProperty('goods');
        $class->addProtectProperty('pp');
        $class->addClassComment('@property string $goodsName');
        $class->addClassComment('@property string $goodsName');
        $class->addPublicMethod('HelloWorld', '', "echo 'hello world';");
        echo $class;
    }

    public function testTrait()
    {
        $class = new ClassT('Test', 'Father');
        $class->addUse('Test/add');
        $class->addTrait('Singleton');
        $class->addPublicProperty('goods');
        $class->addProtectProperty('pp');
        $class->addClassComment('@property string $goodsName');
        $class->addClassComment('@property string $goodsName');
        $class->addPublicMethod('HelloWorld', '', "echo 'hello world';");
        echo $class;
    }
}