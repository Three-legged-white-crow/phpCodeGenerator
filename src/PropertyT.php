<?php

declare(strict_types=1);


namespace src;


class PropertyT
{
    protected $string;

    public function __toString()
    {
        return $this->string;
    }

    public function addPublic($name)
    {
        $this->string .= PHP_EOL . '    public $' . $name . ';' . PHP_EOL;
    }

    public function addProtect($name)
    {
        $this->string .= PHP_EOL . '    protect $' . $name . ';' . PHP_EOL;
    }

    public function addPrivate($name)
    {
        $this->string .= PHP_EOL . '    private $' . $name . ';' . PHP_EOL;
    }
}