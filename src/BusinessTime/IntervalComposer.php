<?php

namespace BusinessTime;

use Carbon\CarbonInterval;

class IntervalComposer
{
    private $inverted;
    private $interval;
    private $unit;
    private $className;

    public function __construct(string $className, bool $inverted, $interval = null, $unit = null)
    {
        $this->className = $className;
        $this->inverted = $inverted;
        $this->interval = $interval;
        $this->unit = $unit;
    }

    public function getInterval(): CarbonInterval
    {
        $interval = $this->interval;

        if ($this->unit) {
            $className = $this->className;
            $interval = "$interval ".$className::pluralUnit($this->unit);
        }

        $interval = CarbonInterval::make($interval) ?: CarbonInterval::create(0);

        if ($this->inverted) {
            $interval->invert();
        }

        return $interval;
    }
}
