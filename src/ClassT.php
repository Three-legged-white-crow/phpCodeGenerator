<?php

declare(strict_types=1);


namespace src;


class ClassT
{
    protected $string;
    protected $classComment;
    protected $classCommentResult;
    protected $class;

    public function __construct($className)
    {
        $this->class = 'class ' . $className;
    }

    public function classComment($comment)
    {
        $this->classComment .= ' * ' . $comment . PHP_EOL;
    }

    public function __toString()
    {
        $this->classCommentResult = '/**' . PHP_EOL . $this->classComment . ' */' . PHP_EOL;
        $this->string             .= $this->classCommentResult;

        return $this->string . $this->class . PHP_EOL . "{" . PHP_EOL . "}";
    }

}