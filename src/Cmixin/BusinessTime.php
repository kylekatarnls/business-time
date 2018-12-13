<?php

namespace Cmixin;

use BusinessTime\MixinBase;

class BusinessTime extends MixinBase
{
    public function setOpeningHours()
    {
        $carbonClass = static::getCarbonClass();
        $staticStorage = &static::$staticOpeningHours;
        $mixin = $this;

        return function ($openingHours) use ($mixin, $carbonClass, &$staticStorage) {
            $convertOpeningHours = $mixin->convertOpeningHours();

            if (!isset($this)) {
                $staticStorage[$carbonClass] = $convertOpeningHours($openingHours);

                return null;
            }

            $storage = call_user_func($mixin->getOpeningHoursStorage());
            $storage[$this] = $convertOpeningHours($openingHours);

            return $this;
        };
    }

    public function resetOpeningHours()
    {
        $carbonClass = static::getCarbonClass();
        $staticStorage = &static::$staticOpeningHours;
        $mixin = $this;

        return function () use ($carbonClass, &$staticStorage, $mixin) {
            if (!isset($this)) {
                unset($staticStorage[$carbonClass]);

                return null;
            }

            $storage = call_user_func($mixin->getOpeningHoursStorage());
            unset($storage[$this]);

            return $this;
        };
    }

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

    public function isOpenExcludingHolidays()
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

    public function isClosedIncludingHolidays()
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
