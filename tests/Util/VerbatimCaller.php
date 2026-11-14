<?php

namespace Tests\Util;

class VerbatimCaller
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
        ($this->closure)();
    }
}
