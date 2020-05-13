<?php

namespace BusinessTime\Traits;

use BusinessTime\Exceptions\InvalidArgumentException;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Cmixin\BusinessTime;

trait AddAndSubtract
{
    protected $maxIteration = BusinessTime::MAX_ITERATION;

    /**
     * Set the maximum of loop turns to run before throwing an exception where trying to add
     * or subtract open/closed time.
     *
     * @return void|\Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function setMaxIteration()
    {
        if (func_num_args()) {
            $this->maxIteration = func_get_arg(0);

            return;
        }

        $mixin = $this;

        /**
         * Set the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        return function (int $maxIteration) use ($mixin) {
            $mixin->setMaxIteration($maxIteration);
        };
    }

    /**
     * Get the maximum of loop turns to run before throwing an exception where trying to add
     * or subtract open/closed time.
     *
     * @return int|\Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function getMaxIteration()
    {
        if (func_num_args()) {
            return $this->maxIteration;
        }

        $mixin = $this;

        /**
         * Get the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        return function () use ($mixin): int {
            return $mixin->getMaxIteration(true);
        };
    }

    /**
     * Shift current time with a given interval taking into account only open time
     * (if $open is true) or only closed time (if $open is false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function applyBusinessInterval()
    {
        $holidaysAreClosedOption = static::HOLIDAYS_ARE_CLOSED;

        /**
         * Shift current time with a given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $inverted subtract the interval if set to true.
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (bool $inverted, bool $open, $interval = null, $unit = null, int $options = 0) use ($holidaysAreClosedOption) {
            $holidaysAreClosed = $options & $holidaysAreClosedOption;
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();
            $maxIteration = $date->getMaxIteration();

            if ($unit) {
                $interval = "$interval ".static::pluralUnit($unit);
            }

            $interval = CarbonInterval::make($interval) ?: CarbonInterval::create(0);

            if ($inverted) {
                $interval->invert();
            }

            $resultCandidate = $date->copy()->add($interval);
            $past = $resultCandidate < $date;

            $getNext = function (CarbonInterface $date, bool $openState) use ($past, $holidaysAreClosed) {
                $methodPrefix = $past ? 'previous' : 'next';

                if ($holidaysAreClosed) {
                    $methodPrefix .= 'Business';
                }

                return $date->copy()->{$methodPrefix.($past === $openState ? 'Close' : 'Open')}();
            };

            $isInLimit = function (CarbonInterface $possibleResult, CarbonInterface $limitDate) use ($past) {
                return $past ? $possibleResult >= $limitDate : $possibleResult < $limitDate;
            };

            $isInExpectedState = function (CarbonInterface $date) use ($open, $holidaysAreClosed) {
                $methodPrefix = 'is';

                if ($holidaysAreClosed) {
                    $methodPrefix .= 'Business';
                }

                return $date->{$methodPrefix.($open ? 'Open' : 'Closed')}();
            };

            $base = $isInExpectedState($date) || ($past && $isInExpectedState($date->copy()->subMicrosecond())) ? $date : $getNext($date, $open);

            for ($i = 0; $i < $maxIteration; $i++) {
                $next = $getNext($base, !$open);
                $resultCandidate = $base->copy()->add($interval);

                if (!$isInExpectedState($base)) {
                    $next = $getNext($base, !$open);
                }

                if ($isInLimit($resultCandidate, $next)) {
                    return $date->setDateTimeFrom($resultCandidate);
                }

                $interval = $next->diff($resultCandidate, false);
                $base = $getNext($next, $open);
            }

            throw new InvalidArgumentException('Maximum iteration ('.$maxIteration.') has been reached.');
        };
    }

    /**
     * Add the given interval taking into account only open time
     * (if $open is true) or only closed time (if $open is false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addBusinessInterval()
    {
        /**
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (bool $open, $interval = null, $unit = null, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->applyBusinessInterval(false, $open, $interval, $unit, $options);
        };
    }

    /**
     * Add the given interval taking into account only open time
     * (if $open is true) or only closed time (if $open is false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function subBusinessInterval()
    {
        /**
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (bool $open, $interval = null, $unit = null, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->applyBusinessInterval(true, $open, $interval, $unit, $options);
        };
    }

    /**
     * Add the given interval taking into account only open time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addOpenTime()
    {
        /**
         * Add the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function ($interval = null, $unit = null, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->addBusinessInterval(true, $interval, $unit, $options);
        };
    }

    /**
     * Subtract the given interval taking into account only open time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function subOpenTime()
    {
        /**
         * Subtract the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function ($interval = null, $unit = null, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->subBusinessInterval(true, $interval, $unit, $options);
        };
    }

    /**
     * Add the given interval taking into account only closed time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addClosedTime()
    {
        /**
         * Add the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function ($interval = null, $unit = null, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->addBusinessInterval(false, $interval, $unit, $options);
        };
    }

    /**
     * Subtract the given interval taking into account only closed time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function subClosedTime()
    {
        /**
         * Subtract the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function ($interval = null, $unit = null, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->subBusinessInterval(false, $interval, $unit, $options);
        };
    }

    /**
     * Add the given number of minutes taking into account only open time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addOpenMinutes()
    {
        /**
         * Add the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfMinutes, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->addOpenTime($numberOfMinutes, 'minutes', $options);
        };
    }

    /**
     * Subtract the given number of minutes taking into account only open time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function subOpenMinutes()
    {
        /**
         * Subtract the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfMinutes, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->subOpenTime($numberOfMinutes, 'minutes', $options);
        };
    }

    /**
     * Add the given number of minutes taking into account only closed time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addClosedMinutes()
    {
        /**
         * Add the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfMinutes, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->addClosedTime($numberOfMinutes, 'minutes', $options);
        };
    }

    /**
     * Subtract the given number of minutes taking into account only closed time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function subClosedMinutes()
    {
        /**
         * Subtract the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfMinutes, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->subClosedTime($numberOfMinutes, 'minutes', $options);
        };
    }

    /**
     * Add the given number of hours taking into account only open time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addOpenHours()
    {
        /**
         * Add the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfHours, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->addOpenTime($numberOfHours, 'hours', $options);
        };
    }

    /**
     * Subtract the given number of hours taking into account only open time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function subOpenHours()
    {
        /**
         * Subtract the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfHours, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->subOpenTime($numberOfHours, 'hours', $options);
        };
    }

    /**
     * Add the given number of hours taking into account only closed time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addClosedHours()
    {
        /**
         * Add the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfHours, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->addClosedTime($numberOfHours, 'hours', $options);
        };
    }

    /**
     * Subtract the given number of hours taking into account only closed time.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function subClosedHours()
    {
        /**
         * Subtract the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (int $numberOfHours, int $options = 0) {
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            return $date->subClosedTime($numberOfHours, 'hours', $options);
        };
    }
}
