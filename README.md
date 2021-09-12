# phpCodeGenerator

## install

```
composer require three-legged-white-crow/php-code-generator dev-main
```

## how to use

input:

```
        $class = new ClassT('Test', 'Father');
        $class->addUse('Test/add');
        $class->addPublicProperty('goods');
        $class->addProtectProperty('pp');
        $class->addClassComment('@property string $goodsName');
        $class->addClassComment('@property string $goodsName');
        $class->addPublicMethod('HelloWorld', '', "echo 'hello world';");
        echo $class;
```

output:

```
use Test/add;

/**
 * @property string $goodsName
 * @property string $goodsName
 */
class Test extends Father
{

    public $goods;

    protected $pp;

    public function HelloWorld()
    {
        echo 'hello world';
    }
}

```