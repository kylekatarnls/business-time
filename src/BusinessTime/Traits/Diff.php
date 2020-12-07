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
         * @param string                                                 $unit    Unit such as 'hour', 'minute' to use
         *                                                                        for the total to return;
         *                                                                        or 'interval' to return a
         *                                                                        CarbonInterval instance
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param int                                                    $options options (as bytes-union) such as:
         *                                                                        - BusinessTime::CLOSED_TIME
         *                                                                        => return the interval of for closed time,
         *                                                                        return open time else
         *                                                                        - BusinessTime::RELATIVE_DIFF
         *                                                                        => return negative value if start is before end
         *                                                                        - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                        => holidays are automatically considered as closed
         *                                                                        - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                        => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return \Carbon\CarbonInterval|float
         */
        return static function (string $unit, $date = null, int $options = 0) {
            /** @var CarbonInterface $start */
            $start = static::this();
            $calculator = new DiffCalculator($unit);
            $calculator->setFlags(
                !($options & BusinessTime::CLOSED_TIME),
                !($options & BusinessTime::RELATIVE_DIFF),
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
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param int                                                    $options options (as bytes-union) such as:
         *                                                                        - BusinessTime::CLOSED_TIME
         *                                                                        => return the interval of for closed time,
         *                                                                        return open time else
         *                                                                        - BusinessTime::RELATIVE_DIFF
         *                                                                        => return negative value if start is before end
         *                                                                        - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                        => holidays are automatically considered as closed
         *                                                                        - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                        => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return \Carbon\CarbonInterval
         */
        return static function ($date = null, int $options = 0): CarbonInterval {
            return static::this()->diffInBusinessUnit('interval', $date, $options);
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
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param int                                                    $options options (as bytes-union) such as:
         *                                                                        - BusinessTime::CLOSED_TIME
         *                                                                        => return the interval of for closed time,
         *                                                                        return open time else
         *                                                                        - BusinessTime::RELATIVE_DIFF
         *                                                                        => return negative value if start is before end
         *                                                                        - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                        => holidays are automatically considered as closed
         *                                                                        - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                        => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return float
         */
        return static function ($date = null, int $options = 0): float {
            return static::this()->diffInBusinessUnit('second', $date, $options);
        };
    }

    /**
     * Return a number of minutes with open/closed business time between the current date and an other
     * given date.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function diffInBusinessMinutes()
    {
        /**
         * Return a number of minutes with open/closed business time between the current date and an other
         * given date.
         *
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param int                                                    $options options (as bytes-union) such as:
         *                                                                        - BusinessTime::CLOSED_TIME
         *                                                                        => return the interval of for closed time,
         *                                                                        return open time else
         *                                                                        - BusinessTime::RELATIVE_DIFF
         *                                                                        => return negative value if start is before end
         *                                                                        - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                        => holidays are automatically considered as closed
         *                                                                        - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                        => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return float
         */
        return static function ($date = null, int $options = 0): float {
            return static::this()->diffInBusinessUnit('minute', $date, $options);
        };
    }

    /**
     * Return a number of hours with open/closed business time between the current date and an other
     * given date.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function diffInBusinessHours()
    {
        /**
         * Return a number of hours with open/closed business time between the current date and an other
         * given date.
         *
         * @param \Carbon\CarbonInterface|\DateTimeInterface|string|null $date
         * @param int                                                    $options options (as bytes-union) such as:
         *                                                                        - BusinessTime::CLOSED_TIME
         *                                                                        => return the interval of for closed time,
         *                                                                        return open time else
         *                                                                        - BusinessTime::RELATIVE_DIFF
         *                                                                        => return negative value if start is before end
         *                                                                        - BusinessTime::HOLIDAYS_ARE_CLOSED
         *                                                                        => holidays are automatically considered as closed
         *                                                                        - BusinessTime::USE_DAYLIGHT_SAVING_TIME
         *                                                                        => use DST native PHP diff result instead of real time (timestamp)
         *
         * @return float
         */
        return static function ($date = null, int $options = 0): float {
            return static::this()->diffInBusinessUnit('hour', $date, $options);
        };
    }
}
