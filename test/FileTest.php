<?php

declare(strict_types=1);

namespace test;

use PHPUnit\Framework\TestCase;
use src\NamespaceT;
use src\StartT;

/**
 * 原文件名是 File.php、类名 File，PHPUnit 只收集 *Test.php，所以这个用例从来没被执行过。
 * 改名为 FileTest 后纳入测试集，顺带补上断言。
 */
class FileTest extends TestCase
{
    public function testOpenTagAndNamespaceAreConcatenated(): void
    {
        $file = (string)new StartT() . (string)new NamespaceT('Test');

        $expected = implode(PHP_EOL, [
            '<?php  ',
            '',
            'namespace Test;',
            '',
            '',
        ]);

        $this->assertSame($expected, $file);
    }

    public function testCombinedOutputIsValidPhp(): void
    {
        $source = (string)new StartT() . (string)new NamespaceT('Test') . PHP_EOL . 'class Demo {}' . PHP_EOL;

        $tmp = tempnam(sys_get_temp_dir(), 'phcgen_');
        $this->assertNotFalse($tmp, '无法创建临时文件');
        file_put_contents($tmp, $source);

        try {
            $output = [];
            $status = 0;
            exec(escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($tmp) . ' 2>&1', $output, $status);

            $this->assertSame(0, $status, '拼出的文件头无法通过 php -l：' . implode(' ', $output));
        } finally {
            @unlink($tmp);
        }
    }
}
