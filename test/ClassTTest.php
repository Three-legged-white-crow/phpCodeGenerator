<?php

declare(strict_types=1);


namespace test;


use src\ClassCommentT;
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
        $class         = new ClassT('Test');
        $classCommentT = new ClassCommentT();
        $classCommentT->classComment('@property string $goodsName');
        $classCommentT->classComment('@property string $goodsName');
        $class->addClassComment($classCommentT);
        echo $class;
    }
}