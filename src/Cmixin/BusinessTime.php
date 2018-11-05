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

    public function getLocalOpeningHours()
    {
        $mixin = $this;

        return function () use ($mixin) {
            return (isset($this) ? $this : $mixin)->getOpeningHours();
        };
    }

    public function isOpenOn()
    {
        $mixin = $this;

        return function ($day) use ($mixin) {
            $normalizeDay = $mixin->normalizeDay();
            $getter = $mixin->getLocalOpeningHours();

            return $getter->call(isset($this) ? $this : $mixin)->isOpenOn($normalizeDay($day));
        };
    }

    public function isClosedOn()
    {
        $mixin = $this;

        return function ($day) use ($mixin) {
            $normalizeDay = $mixin->normalizeDay();
            $getter = $mixin->getLocalOpeningHours();

            return $getter->call(isset($this) ? $this : $mixin)->isClosedOn($normalizeDay($day));
        };
    }

    public function isOpen()
    {
        $carbonClass = static::getCarbonClass();
        $mixin = $this;

        return function () use ($mixin, $carbonClass) {
            if (isset($this)) {
                return $this->getOpeningHours()->isOpenAt($this);
            }

            $getOpeningHours = $mixin->getOpeningHours();

            return $getOpeningHours()->isOpenAt($carbonClass::now());
        };
    }

    public function isClosed()
    {
        $carbonClass = static::getCarbonClass();
        $mixin = $this;

        return function () use ($mixin, $carbonClass) {
            if (isset($this)) {
                return $this->getOpeningHours()->isClosedAt($this);
            }

            $getOpeningHours = $mixin->getOpeningHours();

            return $getOpeningHours()->isClosedAt($carbonClass::now());
        };
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
