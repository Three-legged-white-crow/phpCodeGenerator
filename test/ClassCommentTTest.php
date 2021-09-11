<?php

declare(strict_types=1);


namespace test;


use PHPUnit\Framework\TestCase;
use src\ClassCommentT;

class ClassCommentTTest extends TestCase
{
    public function testClass()
    {
        $classCommentT = new ClassCommentT();
        $classCommentT->classComment('@property string $goodsName');
        $classCommentT->classComment('@property string $goodsName');
        echo $classCommentT;
    }
}