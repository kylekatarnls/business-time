<?php

namespace BusinessTime\Traits;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

trait Range
{
    /**
     * Get OpeningHoursForDay instance of the current instance or class.
     *
     * @return \Closure<\Spatie\OpeningHours\OpeningHoursForDay>
     */
    public function getCurrentDayOpeningHours()
    {
        /**
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        return static function () {
            /** @var Carbon $date */
            $date = static::this();

            return $date->getOpeningHours()->forDate($date);
        };
    }

    /**
     * Get open time ranges as array of TimeRange instances that matches the current date and time.
     *
     * @return \Closure<\Spatie\OpeningHours\TimeRange[]>
     */
    public function getCurrentOpenTimeRanges()
    {
        /**
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        return static function () {
            /** @var Carbon $date */
            $date = static::this();

            return $date->getOpeningHours()->forDateTime($date);
        };
    }

    /**
     * Get current open time range as TimeRange instance or false if closed.
     *
     * @return \Closure<\Spatie\OpeningHours\TimeRange|bool>
     */
    public function getCurrentOpenTimeRange()
    {
        /**
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        return static function () {
            /** @var Carbon $date */
            $date = static::this();

            return $date->getOpeningHours()->currentOpenRange($date) ?: false;
        };
    }

    /**
     * Get current open time range as TimeRange instance or false if closed.
     *
     * @return \Closure<\Carbon\CarbonPeriod|bool>
     */
    public function getCurrentOpenTimePeriod()
    {
        /**
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @param string|\DateInterval $interval
         *
         * @return \Carbon\CarbonPeriod|bool
         */
        return static function ($interval = null) {
            /** @var Carbon $date */
            $date = static::this();
            $range = $date->getOpeningHours()->currentOpenRange($date);

            if (!$range) {
                return false;
            }

            $time = $date->format('H:i');
            $start = $range->start();
            $end = $range->end();

            return new CarbonPeriod(
                $date->copy()->modify($start.($start > $time ? ' - 1 day' : '')),
                $interval ?? 'PT1M',
                $date->copy()->modify($end.($end < $time ? ' + 1 day' : ''))
            );
        };
    }

    /**
     * Get current open time range start as Carbon instance or false if closed.
     * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool>
     */
    public function getCurrentOpenTimeRangeStart()
    {
        /**
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        return $this->getCalleeAsMethod(static::CURRENT_OPEN_RANGE_START_METHOD);
    }

    /**
     * Get current open time range end as Carbon instance or false if closed.
     * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool>
     */
    public function getCurrentOpenTimeRangeEnd()
    {
        /**
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        return $this->getCalleeAsMethod(static::CURRENT_OPEN_RANGE_END_METHOD);
    }

    /**
     * Get current open time range start as Carbon instance or false if closed or holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool>
     */
    public function getCurrentBusinessTimeRangeStart()
    {
        /**
         * Get current open time range start as Carbon instance or false if closed or holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        return $this->getCalleeAsMethod(static::CURRENT_OPEN_RANGE_START_METHOD, ['isHoliday', false]);
    }

    /**
     * Get current open time range end as Carbon instance or false if closed.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool>
     */
    public function getCurrentBusinessOpenTimeRangeEnd()
    {
        /**
         * Get current open time range end as Carbon instance or false if closed.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        return $this->getCalleeAsMethod(static::CURRENT_OPEN_RANGE_END_METHOD, ['isHoliday', false]);
    }
}
