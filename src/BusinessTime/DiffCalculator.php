<?php

namespace BusinessTime;

use BusinessTime\Exceptions\InvalidArgumentException;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Spatie\OpeningHours\OpeningHours;

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

    public function __construct(string $unit, string $methodPrefix = 'floatDiffIn')
    {
        $this->unit = ucfirst(Carbon::pluralUnit($unit));
        $this->methodPrefix = $methodPrefix;
    }

    public function setFlags(bool $open, bool $absolute, bool $holidaysAreClosed, bool $useDst)
    {
        $this->open = $open;
        $this->absolute = $absolute;
        $this->holidaysAreClosed = $holidaysAreClosed;
        $this->useDst = $useDst;
    }

    public function calculateDiff(CarbonInterface $start, CarbonInterface $end)
    {
        if ($this->unit === 'Intervals') {
            $this->unit = 'Seconds';

            return CarbonInterval::createFromFormat(
                's.u',
                number_format($this->calculateFloatDiff($start, $end), 6, '.', '')
            )->cascade();
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
        $hours = $this->getOpeningHours($start);
        $date = $this->copy($start);

        while ($date < $end) {
            if ($date->$isWrongState()) {
                $date = $this->withOpeningHours($date->$nextCorrectState(), $hours);

                continue;
            }

            $nextDate = $this->withOpeningHours($this->copy($date)->$nextWrongState(), $hours);
            $time += $date->$floatDiff(min($end, $nextDate));
            $date = $nextDate;
        }

        return $time;
    }

    protected function copy(CarbonInterface $date): CarbonInterface
    {
        return $this->withOpeningHours($date->copy(), $this->getOpeningHours($date));
    }

    protected function withOpeningHours(CarbonInterface $date, ?OpeningHours $hours): CarbonInterface
    {
        if ($hours) {
            return $date->setOpeningHours($hours);
        }

        return $date;
    }

    protected function getOpeningHours(CarbonInterface $date): ?OpeningHours
    {
        try {
            return $date->getOpeningHours(MixinBase::LOCAL_MODE);
        } catch (InvalidArgumentException $exception) {
            return null;
        }
    }
}
