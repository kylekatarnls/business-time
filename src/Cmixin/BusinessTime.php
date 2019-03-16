<?php

namespace Cmixin;

use BusinessTime\MixinBase;

class BusinessTime extends MixinBase
{
    public function getCurrentDayOpeningHours()
    {
        $carbonClass = static::getCarbonClass();

        return function () use ($carbonClass) {
            $date = isset($this) ? $this : $carbonClass::now();

            return $date->getOpeningHours()->forDate($date);
        };
    }

    public function isOpenOn($method = null)
    {
        $mixin = $this;
        $method = preg_replace('/^.*::/', '', $method ?: __METHOD__);

        return function ($day) use ($mixin, $method) {
            $normalizeDay = $mixin->normalizeDay();

            if (isset($this)) {
                return $this->getOpeningHours()->$method($normalizeDay($day));
            }

            $getOpeningHours = $mixin->getOpeningHours();

            return $getOpeningHours()->$method($normalizeDay($day));
        };
    }

    public function isClosedOn()
    {
        return $this->isOpenOn(__METHOD__);
    }

    public function isOpen($method = null)
    {
        $carbonClass = static::getCarbonClass();
        $mixin = $this;
        $method = preg_replace('/^.*::/', '', $method ?: __METHOD__).'At';

        return function () use ($mixin, $carbonClass, $method) {
            if (isset($this)) {
                return $this->getOpeningHours()->$method($this);
            }

            $getOpeningHours = $mixin->getOpeningHours();

            return $getOpeningHours()->$method($carbonClass::now());
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
            if (isset($this)) {
                return $this->getOpeningHours()->isOpenAt($this) && !$this->isHoliday();
            }

            $getOpeningHours = $mixin->getOpeningHours();
            $now = $carbonClass::now();

            return $getOpeningHours()->isOpenAt($now) && !$now->isHoliday();
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
            if (isset($this)) {
                return $this->getOpeningHours()->isClosedAt($this) || $this->isHoliday();
            }

            $getOpeningHours = $mixin->getOpeningHours();
            $now = $carbonClass::now();

            return $getOpeningHours()->isClosedAt($now) || $now->isHoliday();
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
