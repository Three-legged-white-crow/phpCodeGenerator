<?php

declare(strict_types=1);

namespace test;

use PHPUnit\Framework\TestCase;
use src\ClassT;

/**
 * 全部断言都用精确字符串比对（assertSame + implode(PHP_EOL, [...])），
 * 不做子串匹配 —— 缩进、空行、大括号位置都是输出契约的一部分，
 * 少一层缩进或多一个空行在子串匹配下抓不到。
 *
 * 注意：空 docblock（只有起止标记）和空类体（左大括号后直接空行）是既有输出格式，
 * 改它们会让已生成的代码文件产生无意义 diff，所以这里固化既有行为，不做"优化"。
 */
class ClassTTest extends TestCase
{
    public function testMinimalClass(): void
    {
        $expected = implode(PHP_EOL, [
            '',
            '/**',
            ' */',
            'class Test',
            '{',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)new ClassT('Test'));
    }

    public function testExtendsIsAppendedToClassDeclaration(): void
    {
        $expected = implode(PHP_EOL, [
            '',
            '/**',
            ' */',
            'class Test extends Father',
            '{',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)new ClassT('Test', 'Father'));
    }

    public function testClassCommentGoesIntoDocblock(): void
    {
        $class = new ClassT('Test');
        $class->addClassComment('@property string $goodsName');

        $expected = implode(PHP_EOL, [
            '',
            '/**',
            ' * @property string $goodsName',
            ' */',
            'class Test',
            '{',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)$class);
    }

    public function testMultipleCommentsKeepTheirOrder(): void
    {
        $class = new ClassT('Test');
        $class->addClassComment('@property string $goodsName');
        $class->addClassComment('@property int $goodsId');

        $this->assertStringContainsString(
            ' * @property string $goodsName' . PHP_EOL . ' * @property int $goodsId',
            (string)$class,
            '多条类注释应按添加顺序逐行落在 docblock 里'
        );
    }

    public function testUseStatementsGoAboveDocblock(): void
    {
        $class = new ClassT('Test');
        $class->addUse('app\Base');

        $expected = implode(PHP_EOL, [
            'use app\Base;',
            '',
            '/**',
            ' */',
            'class Test',
            '{',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)$class);
    }

    public function testThreePropertyVisibilities(): void
    {
        $class = new ClassT('Test');
        $class->addPublicProperty('goods');
        $class->addProtectProperty('pp');
        $class->addPrivateProperty('priv');

        $expected = implode(PHP_EOL, [
            '',
            '/**',
            ' */',
            'class Test',
            '{',
            '',
            '    public $goods;',
            '',
            '    protected $pp;',
            '',
            '    private $priv;',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)$class);
    }

    public function testMethodBodyIsIndentedEightSpaces(): void
    {
        $class = new ClassT('Test');
        $class->addPublicMethod('hello', '', 'return 1;');

        $expected = implode(PHP_EOL, [
            '',
            '/**',
            ' */',
            'class Test',
            '{',
            '',
            '    public function hello()',
            '    {',
            '        return 1;',
            '    }',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)$class);
    }

    public function testMethodParametersArePassedThroughVerbatim(): void
    {
        $class = new ClassT('Test');
        $class->addPublicMethod('find', '$id, $with = []', 'return $id;');

        $this->assertStringContainsString(
            '    public function find($id, $with = [])',
            (string)$class,
            '参数串应原样拼进括号，不该被二次处理'
        );
    }

    public function testTraitSitsDirectlyUnderOpeningBrace(): void
    {
        $class = new ClassT('Test');
        $class->addTrait('Singleton');

        $expected = implode(PHP_EOL, [
            '',
            '/**',
            ' */',
            'class Test',
            '{',
            '    use Singleton;',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)$class);
    }

    /**
     * 全量拼装：顺序必须是 use -> docblock -> class -> trait -> property -> method。
     * 任何一段插错位置都会让生成的代码无法通过 php -l，所以整段逐字比对。
     */
    public function testFullAssemblyOrder(): void
    {
        $class = new ClassT('Demo', '\think\Model');
        $class->addUse('app\Base');
        $class->addTrait('Singleton');
        $class->addPublicProperty('goods');
        $class->addClassComment('@property string $goodsName');
        $class->addPublicMethod('hello', '', 'return 1;');

        $expected = implode(PHP_EOL, [
            'use app\Base;',
            '',
            '/**',
            ' * @property string $goodsName',
            ' */',
            'class Demo extends \think\Model',
            '{',
            '    use Singleton;',
            '',
            '    public $goods;',
            '',
            '    public function hello()',
            '    {',
            '        return 1;',
            '    }',
            '',
            '}',
        ]);

        $this->assertSame($expected, (string)$class);
    }

    /**
     * __toString 每次都是从成员变量重建，不能把上次的结果追加进去。
     * 一旦写成 `$this->string .=`，第二次调用就会输出两份内容。
     */
    public function testToStringIsIdempotent(): void
    {
        $class = new ClassT('Test');
        $class->addPublicProperty('goods');

        $first  = (string)$class;
        $second = (string)$class;

        $this->assertSame($first, $second, '__toString 反复调用必须返回同一份内容');
        $this->assertSame(1, substr_count($second, 'class Test'), '类声明只能出现一次');
    }
}
