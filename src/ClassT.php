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

    public function __construct($className)
    {
        $this->class = 'class ' . $className;
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

    public function __toString()
    {
        $this->classCommentResult = '/**' . PHP_EOL . $this->classComment . ' */' . PHP_EOL;
        $this->string             = $this->classCommentResult . $this->class . PHP_EOL . "{" . PHP_EOL;
        $this->string             .= $this->property;

        return $this->string . PHP_EOL . "}";
    }

}