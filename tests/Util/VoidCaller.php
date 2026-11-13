<?php

namespace Tests\Util;

class VoidCaller
{
    /**
     * @var \Closure
     */
    private $closure;

    public function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }

    public function __invoke()
    {
        (void) ($this->closure)();
    }
}