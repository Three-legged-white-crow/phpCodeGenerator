<?php

declare(strict_types=1);


namespace src;


class ClassT
{
    protected $string;
    protected $classComment;
    protected $classCommentResult;
    protected $class;
    protected $property;
    protected $method;
    protected $use;
    protected $trait;

    public function __construct($className, $extends = '')
    {
        if ($extends) {
            $this->class = 'class ' . $className . ' extends ' . $extends;
        } else {
            $this->class = 'class ' . $className;
        }
    }

    public function __toString()
    {
        $this->classCommentResult = $this->use . PHP_EOL . '/**' . PHP_EOL . $this->classComment . ' */'
                                    . PHP_EOL;
        $this->string             = $this->classCommentResult . $this->class . PHP_EOL . "{" . PHP_EOL;
        $this->string             .= $this->trait;
        $this->string             .= $this->property;
        $this->string             .= $this->method;

        return $this->string . PHP_EOL . "}";
    }

    public function addUse($use)
    {
        $this->use .= 'use ' . $use . ';' . PHP_EOL;
    }

    public function addClassComment($comment)
    {
        $this->classComment .= ' * ' . $comment . PHP_EOL;
    }

    public function addPublicProperty($name)
    {
        $this->property .= PHP_EOL . '    public $' . $name . ';' . PHP_EOL;
    }

    public function addProtectProperty($name)
    {
        $this->property .= PHP_EOL . '    protected $' . $name . ';' . PHP_EOL;
    }

    public function addPrivateProperty($name)
    {
        $this->property .= PHP_EOL . '    private $' . $name . ';' . PHP_EOL;
    }

    public function addPublicMethod($methodName, $params, $content)
    {
        $this->method .= PHP_EOL . '    public function ' . $methodName . '(' . $params . ')' . PHP_EOL
                         . '    {' . PHP_EOL
                         . '        ' . $content . PHP_EOL
                         . '    }';
    }

    public function addProtectedMethod($methodName, $params, $content)
    {
        $this->method .= PHP_EOL . '    protected function ' . $methodName . '(' . $params . ')' . PHP_EOL
                         . '    {' . PHP_EOL
                         . '        ' . $content . PHP_EOL
                         . '    }';
    }

    public function addPrivateMethod($methodName, $params, $content)
    {
        $this->method .= PHP_EOL . '    private function ' . $methodName . '(' . $params . ')' . PHP_EOL
                         . '    {' . PHP_EOL
                         . '        ' . $content . PHP_EOL
                         . '    }';
    }

    public function addTrait($name)
    {
        $this->trait .= '    use ' . $name . ';' . PHP_EOL;
    }
}