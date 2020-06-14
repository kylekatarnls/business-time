<?php

namespace BusinessTime;

use BusinessTime\Exceptions\InvalidArgumentException;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use DateInterval;

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

    public function __construct(string $unit, bool $open, bool $absolute, bool $holidaysAreClosed, bool $useDst)
    {
        $this->unit = ucfirst(Carbon::pluralUnit($unit));
        $this->open = $open;
        $this->absolute = $absolute;
        $this->holidaysAreClosed = $holidaysAreClosed;
        $this->useDst = $useDst;
    }

    public function calculateDiff(CarbonInterface $start, CarbonInterface $end)
    {
        if ($this->unit === 'Intervals') {
            $this->unit = 'Seconds';

            return CarbonInterval::createFromFormat('U.u', $this->calculateFloatDiff($start, $end));
        }

        return $this->calculateFloatDiff($start, $end);
    }

    public function calculateFloatDiff(CarbonInterface $start, CarbonInterface $end): float
    {
        if ($end < $start) {
            return ($this->absolute ? 1 : -1) * $this->calculateFloatDiff($end, $start);
        }

        $time = 0;
        $floatDiff = 'floatDiffIn'.($this->useDst ? '' : 'Real').$this->unit;
        $isWrongState = 'is'.($this->holidaysAreClosed ? 'Business' : '').($this->open ? 'Closed' : 'Open');
        $nextWrongState = 'next'.($this->holidaysAreClosed ? 'Business' : '').($this->open ? 'Close' : 'Open');
        $nextCorrectState = 'next'.($this->holidaysAreClosed ? 'Business' : '').($this->open ? 'Open' : 'Close');
        $date = $start->copy();

        while ($date < $end) {
            if ($date->$isWrongState()) {
                $date = $date->$nextCorrectState();

                continue;
            }

            $nextDate = $date->$nextWrongState();
            $time += $date->$floatDiff(min($end, $nextDate));
            $date = $nextDate;
        }

        return $time;
    }
}
