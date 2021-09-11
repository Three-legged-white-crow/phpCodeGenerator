# phpCodeGenerator

## install

```
composer require three-legged-white-crow/php-code-generator dev-main
```

## how to use

input:

```
        $class = new ClassT('Test');
        $class->addPublicProperty('goods');
        $class->addProtectProperty('pp');
        $class->addClassComment('@property string $goodsName');
        $class->addClassComment('@property string $goodsName');
        $class->addPublicMethod('HelloWorld', '', "echo 'hello world';");
        echo $class;
```

output:

```
/**
 * @property string $goodsName
 * @property string $goodsName
 */
class Test
{

    public $goods;

    protected $pp;

    public function HelloWorld()
    {
        echo 'hello world';
    }
}
```