<?php

declare(strict_types=1);

namespace test;

use PHPUnit\Framework\TestCase;
use src\NamespaceT;

class NamespaceTTest extends TestCase
{
    public function testSingleLevelNamespace(): void
    {
        $this->assertSame('namespace src;' . PHP_EOL . PHP_EOL, (string)new NamespaceT('src'));
    }

    public function testNestedNamespaceKeepsBackslashes(): void
    {
        $this->assertSame(
            'namespace app\api\service;' . PHP_EOL . PHP_EOL,
            (string)new NamespaceT('app\api\service'),
            '多层命名空间的反斜杠应原样保留'
        );
    }

    public function testEndsWithBlankLineToSeparateFollowingBlock(): void
    {
        $this->assertStringEndsWith(PHP_EOL . PHP_EOL, (string)new NamespaceT('src'));
    }

    public function testStatementIsTerminatedWithSemicolon(): void
    {
        $this->assertStringStartsWith('namespace src;', (string)new NamespaceT('src'));
    }
}
