<?php

namespace BusinessTime;

use Carbon\CarbonInterval;

class IntervalComposer
{
    private $inverted;
    private $interval;
    private $unit;
    private $className;

    public function __construct(string $className, bool $inverted, $interval, $unit)
    {
        $this->className = $className;
        $this->inverted = $inverted;
        $this->interval = $interval;
        $this->unit = $unit;
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @throws \Exception
     *
     * @return CarbonInterval
     */
    public function getInterval(): CarbonInterval
    {
        $intervalResult = $this->interval;

        if ($this->unit) {
            $class = $this->className;
            $intervalResult = "$intervalResult ".$class::pluralUnit($this->unit);
        }

        $intervalResult = CarbonInterval::make($intervalResult) ?: CarbonInterval::create(0);

        if ($this->inverted) {
            $intervalResult->invert();
        }

        return $intervalResult;
    }
}
