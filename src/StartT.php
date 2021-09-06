<?php

declare(strict_types=1);


namespace src;


class StartT
{
    protected $start;

    public function __construct()
    {
        $this->start = "<?php  " . PHP_EOL . PHP_EOL;
    }

    public function __toString()
    {
        return $this->start;
    }
}