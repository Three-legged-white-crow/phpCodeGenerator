<?php

declare(strict_types=1);


namespace src;

class ClassCommentT
{
    protected $comment;
    protected $string;

    public function classComment($comment)
    {
        $this->comment .= ' * ' . $comment . PHP_EOL;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $this->string .= '/**' . PHP_EOL . $this->comment . ' */' . PHP_EOL;

        return $this->string;
    }
}