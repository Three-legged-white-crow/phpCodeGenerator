<?php

declare(strict_types=1);


namespace src;


class ClassT
{
    protected $string;
    protected $classComment;
    protected $class;

    public function __construct($className)
    {
        $this->class = 'class ' . $className;
    }

    public function __toString()
    {
        $this->string .= $this->classComment;

        return $this->string . $this->class . PHP_EOL . "{" . PHP_EOL . "}";
    }

    public function addClassComment($classComment)
    {
        $this->classComment = $classComment;
    }
}