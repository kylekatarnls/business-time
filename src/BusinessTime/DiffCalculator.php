<?php

namespace BusinessTime;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;

class DiffCalculator
{
    /**
     * @var string
     */
    protected $unit;

    /**
     * @var bool
     */
    protected $open;

    /**
     * @var bool
     */
    protected $absolute;

    /**
     * @var bool
     */
    protected $holidaysAreClosed;

    /**
     * @var bool
     */
    protected $useDst;

    /**
     * @var string
     */
    protected $methodPrefix;

    public function __construct(string $unit, bool $open, bool $absolute, bool $holidaysAreClosed, bool $useDst, string $methodPrefix = 'floatDiffIn')
    {
        $this->unit = ucfirst(Carbon::pluralUnit($unit));
        $this->open = $open;
        $this->absolute = $absolute;
        $this->holidaysAreClosed = $holidaysAreClosed;
        $this->useDst = $useDst;
        $this->methodPrefix = $methodPrefix;
    }

    public function calculateDiff(CarbonInterface $start, CarbonInterface $end)
    {
        if ($this->unit === 'Intervals') {
            $this->unit = 'Seconds';

            return CarbonInterval::createFromFormat('s.u', number_format($this->calculateFloatDiff($start, $end), 6, '.', ''))->cascade();
        }

        return $this->calculateFloatDiff($start, $end);
    }

    public function calculateFloatDiff(CarbonInterface $start, CarbonInterface $end): float
    {
        if ($end < $start) {
            return ($this->absolute ? 1 : -1) * $this->calculateFloatDiff($end, $start);
        }

        $time = 0;
        $floatDiff = $this->methodPrefix.($this->useDst ? '' : 'Real').$this->unit;
        $isWrongState = 'is'.($this->holidaysAreClosed ? 'Business' : '').($this->open ? 'Closed' : 'Open');
        $nextWrongState = 'next'.($this->holidaysAreClosed ? 'Business' : '').($this->open ? 'Close' : 'Open');
        $nextCorrectState = 'next'.($this->holidaysAreClosed ? 'Business' : '').($this->open ? 'Open' : 'Close');
        $date = $start->copy();

        while ($date < $end) {
            if ($date->$isWrongState()) {
                $date = $date->$nextCorrectState();

                continue;
            }

            $nextDate = $date->copy()->$nextWrongState();
            $time += $date->$floatDiff(min($end, $nextDate));
            $date = $nextDate;
        }

        return $time;
    }
}
