<?php

declare(strict_types=1);


namespace test;

use PHPUnit\Framework\TestCase;
use src\StartT;

class StartTTest extends TestCase
{
    public function testClass()
    {
        $class = new StartT();
        echo $class;
    }
}