<?php

namespace BusinessTime\Traits;

use BusinessTime\DiffCalculator;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Cmixin\BusinessTime;

trait Diff
{
    /**
     * Return an interval/count of given unit with open/closed business time between the current date and an other
     * given date.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function diffInBusinessUnit()
    {
        /**
         * Return an interval/count of given unit with open/closed business time between the current date and an other
         * given date.
         *
         * @param string                                                 $unit     Unit such as 'hour', 'minute' to use
         *                                                                         for the total to return;
         *                                                                         or 'interval' to return a
         *                                                                         CarbonInterval instance
         * @param bool                                                   $open     true for open time,
         *                                                                         false for closed time
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param bool                                                   $absolute Get the absolute of the difference
         * @param int                                                    $options  options (as bytes-union) such as:
         *                                                                         - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                         => holidays are automatically considered as closed
         *                                                                         - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                         => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return \Carbon\CarbonInterval|float
         */
        return function (string $unit, bool $open, $date = null, bool $absolute = true, int $options = 0) {
            /** @var CarbonInterface $start */
            $start = isset($this) ? $this : static::now();
            $calculator = new DiffCalculator(
                $unit,
                $open,
                $absolute,
                $options & BusinessTime::HOLIDAYS_ARE_CLOSED,
                $options & BusinessTime::USE_DAYLIGHT_SAVING_TIME
            );

            return $calculator->calculateDiff($start, $start->resolveCarbon($date));
        };
    }

    /**
     * Return an interval with open/closed business time between the current date and an other
     * given date.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function diffAsBusinessInterval()
    {
        /**
         * Return an interval with open/closed business time between the current date and an other
         * given date.
         *
         * @param bool                                                   $open     true for open time,
         *                                                                         false for closed time
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param bool                                                   $absolute Get the absolute of the difference
         * @param int                                                    $options  options (as bytes-union) such as:
         *                                                                         - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                         => holidays are automatically considered as closed
         *                                                                         - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                         => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return \Carbon\CarbonInterval
         */
        return function (bool $open, $date = null, bool $absolute = true, int $options = 0): CarbonInterval {
            /** @var CarbonInterface $start */
            $start = isset($this) ? $this : static::now();

            return $start->diffInBusinessUnit('interval', $open, $date, $absolute, $options);
        };
    }

    /**
     * Return a number of seconds with open/closed business time between the current date and an other
     * given date.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function diffInBusinessSeconds()
    {
        /**
         * Return a number of seconds with open/closed business time between the current date and an other
         * given date.
         *
         * @param bool                                                   $open     true for open time,
         *                                                                         false for closed time
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param bool                                                   $absolute Get the absolute of the difference
         * @param int                                                    $options  options (as bytes-union) such as:
         *                                                                         - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                         => holidays are automatically considered as closed
         *                                                                         - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                         => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return float
         */
        return function (bool $open, $date = null, bool $absolute = true, int $options = 0): float {
            /** @var CarbonInterface $start */
            $start = isset($this) ? $this : static::now();

            return $start->diffInBusinessUnit('second', $open, $date, $absolute, $options);
        };
    }
}
