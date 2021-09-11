<?php

declare(strict_types=1);


namespace test;


use src\PropertyT;

class PropertyTTest extends \PHPUnit\Framework\TestCase
{
    public function testClass()
    {
        $propertyT = new PropertyT();
        $propertyT->addPublic('aka');
        $propertyT->addPublic('jj');
        $propertyT->addProtect('sks');
        echo $propertyT;
    }
}