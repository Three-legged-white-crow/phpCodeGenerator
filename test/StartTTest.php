<?php

declare(strict_types=1);

namespace test;

use PHPUnit\Framework\TestCase;
use src\StartT;

class StartTTest extends TestCase
{
    /**
     * 既有输出格式：`<?php` 后固定两个空格再换行，生成的文件首行因此带尾随空格。
     * 这是历史行为，改动会让已生成文件的 diff 变成全量，故固化在断言里。
     */
    public function testEmitsOpenTagWithTwoSpacePadding(): void
    {
        $this->assertSame('<?php  ' . PHP_EOL . PHP_EOL, (string)new StartT());
    }

    public function testEndsWithBlankLineToSeparateFollowingBlock(): void
    {
        $this->assertStringEndsWith(PHP_EOL . PHP_EOL, (string)new StartT());
    }

    public function testDoesNotContainClosingTag(): void
    {
        $this->assertStringNotContainsString('?>', (string)new StartT(), '生成的文件不应带结束标记');
    }
}
