<?php

namespace Cmixin;

use BusinessTime\MixinBase;

class BusinessTime extends MixinBase
{
    public function getCurrentDayOpeningHours()
    {
        return function () {
            $date = isset($this) ? $this : static::now();

            return $date->getOpeningHours()->forDate($date);
        };
    }

    public function isOpenOn($method = null)
    {
        $mixin = $this;
        $method = preg_replace('/^.*::/', '', $method ?: __METHOD__);

        return function ($day) use ($mixin, $method) {
            $day = static::normalizeDay($day);
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();

            return $openingHours->$method($day);
        };
    }

    public function isClosedOn()
    {
        return $this->isOpenOn(__METHOD__);
    }

    public function isOpen($method = null)
    {
        $mixin = $this;
        $method = preg_replace('/^.*::/', '', $method ?: __METHOD__).'At';

        return function () use ($mixin, $method) {
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();
            $date = isset($this) ? $this : static::now();

            return $openingHours->$method($date);
        };
    }

    public function isClosed()
    {
        return $this->isOpen(__METHOD__);
    }

    public function isBusinessOpen()
    {
        $carbonClass = static::getCarbonClass();
        $mixin = $this;

        return function () use ($mixin, $carbonClass) {
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();
            $date = isset($this) ? $this : static::now();

            return $openingHours->isOpenAt($date) && !$date->isHoliday();
        };
    }

    public function isOpenExcludingHolidays()
    {
        return $this->isBusinessOpen();
    }

    public function isBusinessClosed()
    {
        $carbonClass = static::getCarbonClass();
        $mixin = $this;

        return function () use ($mixin, $carbonClass) {
            $openingHours = isset($this) ? $this->getOpeningHours() : static::getOpeningHours();
            $date = isset($this) ? $this : static::now();

            return $openingHours->isClosedAt($date) || $date->isHoliday();
        };
    }

    public function isClosedIncludingHolidays()
    {
        return $this->isBusinessClosed();
    }

    public function nextOpen()
    {
        return $this->getCalleeAsMethod(static::NEXT_OPEN_METHOD);
    }

    public function nextClose()
    {
        return $this->getCalleeAsMethod(static::NEXT_CLOSE_METHOD);
    }

    public function nextOpenExcludingHolidays()
    {
        return $this->getMethodLoopOnHoliday(static::NEXT_OPEN_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    public function nextCloseIncludingHolidays()
    {
        return $this->getMethodLoopOnHoliday(static::NEXT_CLOSE_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }
}
