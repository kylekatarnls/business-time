<?php

namespace BusinessTime\Traits;

trait IsMethods
{
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
        return static function ($day) use ($method) {
            $date = end(static::$macroContextStack);
            $day = static::normalizeDay($day);
            $openingHours = $date
                ? $date->getOpeningHours()
                : static::getOpeningHours();

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
        return static function () use ($method) {
            $date = static::this();
            $openingHours = end(static::$macroContextStack)
                ? $date->getOpeningHours()
                : static::getOpeningHours();

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
        return static function () {
            $date = static::this();
            $openingHours = end(static::$macroContextStack)
                ? $date->getOpeningHours()
                : static::getOpeningHours();

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
        return static function () {
            $date = static::this();
            $openingHours = end(static::$macroContextStack)
                ? $date->getOpeningHours()
                : static::getOpeningHours();

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
}
