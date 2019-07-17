<?php

namespace Cmixin;

use BusinessTime\MixinBase;

class BusinessTime extends MixinBase
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
        return function () {
            $date = isset($this) ? $this : static::now();

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
        return function () {
            $date = isset($this) ? $this : static::now();

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
        return function () {
            $date = isset($this) ? $this : static::now();

            return $date->getOpeningHours()->currentOpenRange($date);
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
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
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
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
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

    /**
     * Returns true if the business is open on a given day according to current opening hours.
     *
     * @param string $method can be null or 'isClosedOn' to invert the result
     *
     * @return \Closure<bool>
     */
    public function isOpenOn($method = null)
    {
        $method = preg_replace('/^.*::/', '', $method ?: __METHOD__);

        /**
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        return function ($day) use ($method) {
            $day = static::normalizeDay($day);
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();

            return $openingHours->$method($day);
        };
    }

    /**
     * Returns true if the business is closed on a given day according to current opening hours.
     *
     * @return \Closure<bool>
     */
    public function isClosedOn()
    {
        /**
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        return $this->isOpenOn(__METHOD__);
    }

    /**
     * Returns true if the business is open now (or current date and time) according to current opening hours.
     * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @param string $method can be null or 'isClosed' to invert the result
     *
     * @return \Closure<bool>
     */
    public function isOpen($method = null)
    {
        $method = preg_replace('/^.*::/', '', $method ?: __METHOD__).'At';

        /**
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        return function () use ($method) {
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();
            $date = isset($this) ? $this : static::now();

            return $openingHours->$method($date);
        };
    }

    /**
     * Returns true if the business is closed now (or current date and time) according to current opening hours.
     * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<bool>
     */
    public function isClosed()
    {
        /**
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        return $this->isOpen(__METHOD__);
    }

    /**
     * Returns true if the business is open and not an holiday now (or current date and time) according to current
     * opening hours.
     *
     * @return \Closure<bool>
     */
    public function isBusinessOpen()
    {
        /**
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        return function () {
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();
            $date = isset($this) ? $this : static::now();

            return $openingHours->isOpenAt($date) && !$date->isHoliday();
        };
    }

    /**
     * @alias isBusinessOpen
     *
     * Returns true if the business is open and not an holiday now (or current date and time) according to current
     * opening hours.
     *
     * @return \Closure<bool>
     */
    public function isOpenExcludingHolidays()
    {
        /**
         * @alias isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        return $this->isBusinessOpen();
    }

    /**
     * Returns true if the business is closed or an holiday now (or current date and time) according to current
     * opening hours.
     *
     * @return \Closure<bool>
     */
    public function isBusinessClosed()
    {
        /**
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        return function () {
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();
            $date = isset($this) ? $this : static::now();

            return $openingHours->isClosedAt($date) || $date->isHoliday();
        };
    }

    /**
     * @alias isBusinessClosed
     *
     * Returns true if the business is closed or an holiday now (or current date and time) according to current
     * opening hours.
     *
     * @return \Closure<bool>
     */
    public function isClosedIncludingHolidays()
    {
        /**
         * @alias isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        return $this->isBusinessClosed();
    }

    /**
     * Go to the next open date and time.
     * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextOpen()
    {
        /**
         * Go to the next open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getCalleeAsMethod(static::NEXT_OPEN_METHOD);
    }

    /**
     * Go to the next close date and time.
     * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextClose()
    {
        /**
         * Go to the next close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getCalleeAsMethod(static::NEXT_CLOSE_METHOD);
    }

    /**
     * Go to the next open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextOpenExcludingHolidays()
    {
        /**
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_OPEN_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Go to the next open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextBusinessOpen()
    {
        /**
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_OPEN_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Go to the next close date and time or next holiday if sooner.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextCloseIncludingHolidays()
    {
        /**
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_CLOSE_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Go to the next close date and time or next holiday if sooner.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextBusinessClose()
    {
        /**
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_CLOSE_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }
}
