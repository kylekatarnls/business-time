<?php

namespace BusinessTime\Traits;

use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use DateInterval;
use InvalidArgumentException;

trait Add
{
    /**
     * Shift current time with a given interval taking into account only open time
     * (if $open is true) or only closed time (if $open is false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function addBusinessInterval()
    {
        $holidaysAreClosedOption = static::HOLIDAYS_ARE_CLOSED;
        $maxIteration = static::MAX_ITERATION;

        /**
         * Shift current time with a given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return function (bool $open, $interval = null, $unit = null, int $options = 0) use ($holidaysAreClosedOption, $maxIteration) {
            $holidaysAreClosed = $options & $holidaysAreClosedOption;
            /** @var CarbonInterface $date */
            $date = isset($this) ? $this : static::now();

            $interval = CarbonInterval::make($unit
                ? "$interval ".static::pluralUnit($unit)
                : $interval
            ) ?: CarbonInterval::create(0);

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
}
