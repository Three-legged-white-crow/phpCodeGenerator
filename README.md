# phpCodeGenerator

Generate PHP class / namespace / file-header source code as strings — a small
scaffolding helper for building model / service skeletons.

## Requirements

- PHP `>= 8.3`

## Install

```bash
composer require three-legged-white-crow/php-code-generator "^3.0"
```

PHPUnit is a **dev-only** dependency of this package (`require-dev`), so it is
never pulled into your project. You keep whatever PHPUnit version you already use.

> Version notes
>
> | Version | PHP | PHPUnit | Status |
> |---|---|---|---|
> | `3.x` | `>= 8.3` | `^12.5` in `require-dev` | current |
> | `2.x` | `>= 8.2` | `12.0.6` in **`require`** | legacy — pins your PHPUnit |
> | `1.x` | `>= 7.3` | `7.5.20` in **`require`** | legacy — pins your PHPUnit |
>
> `2.x` and `1.x` declare PHPUnit as a production dependency with an exact
> version, which makes them impossible to install next to a different PHPUnit.
> Stay on `3.x` unless you are stuck on PHP < 8.3.

## Usage

### ClassT

```php
use src\ClassT;

$class = new ClassT('Test', 'Father');
$class->addUse('Test\add');
$class->addTrait('Singleton');
$class->addPublicProperty('goods');
$class->addProtectProperty('pp');
$class->addClassComment('@property string $goodsName');
$class->addPublicMethod('HelloWorld', '', "echo 'hello world';");

echo $class;
```

Output:

```php
use Test\add;

/**
 * @property string $goodsName
 */
class Test extends Father
{
    use Singleton;

    public $goods;

    protected $pp;

    public function HelloWorld()
    {
        echo 'hello world';
    }

}
```

### NamespaceT / StartT

```php
use src\NamespaceT;
use src\StartT;

$file = (string)new StartT() . (string)new NamespaceT('app\api');

echo $file;
```

Output (a blank line follows the opening tag and the namespace statement):

```php
<?php  

namespace app\api;

```

## Output contract

The generated string is byte-for-byte stable and covered by tests — indentation,
blank lines and brace placement are all part of the contract:

- opening tag is `<?php` followed by **two spaces** and a newline
- `use` statements come before the class docblock
- every member is preceded by a blank line inside the class body
- method bodies are indented with **8 spaces**
- a closing `?>` is never emitted

Do not "tidy up" the whitespace: downstream projects diff generated files
against the previous run, and cosmetic changes produce noise.

## Tests

```bash
composer install
composer test
```

## License

Apache-2.0
