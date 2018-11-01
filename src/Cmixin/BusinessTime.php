<?php

namespace Cmixin;

use InvalidArgumentException;
use Spatie\OpeningHours\OpeningHours;

class BusinessTime extends BusinessDay
{
    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    public $openingHours = null;

    public function normalizeDay()
    {
        return function ($day) {
            if (is_int($day)) {
                $day %= 7;
                if ($day < 0) {
                    $day += 7;
                }

                return static::$days[$day];
            }

            return $day;
        };
    }

    public function convertOpeningHours()
    {
        return function ($defaultOpeningHours) {
            if ($defaultOpeningHours instanceof OpeningHours) {
                return $defaultOpeningHours;
            }

            if (is_array($defaultOpeningHours)) {
                $hours = [];
                $normalizeDay = static::normalizeDay();
                foreach ($defaultOpeningHours as $key => $value) {
                    $hours[$normalizeDay($key)] = $value;
                }

                return OpeningHours::create($hours);
            }

            throw new InvalidArgumentException('Opening hours parameter should be a '.
                OpeningHours::class.
                ' instance or an array.');
        };
    }

    public static function enable($carbonClass = null, $defaultOpeningHours = null)
    {
        if ($carbonClass === null) {
            return function () {
                return true;
            };
        }

        $mixin = parent::enable($carbonClass);

        if ($defaultOpeningHours) {
            $convertOpeningHours = $mixin->convertOpeningHours();
            $mixin->openingHours = $convertOpeningHours($defaultOpeningHours);
        }

        return $mixin;
    }

    public function setOpeningHours()
    {
        $mixin = $this;

        return function ($openingHours) use ($mixin) {
            $convertOpeningHours = $mixin->convertOpeningHours();

            $handler = isset($this) ? $this : $mixin;
            $handler->openingHours = $convertOpeningHours($openingHours);

            return isset($this) ? $this : null;
        };
    }

    public function getOpeningHours()
    {
        $mixin = $this;

        return function () use ($mixin) {
            $openingHours = isset($this) ? ($this->openingHours ?? null) : null;

            if ($openingHours = $openingHours ?: $mixin->openingHours) {
                return $openingHours;
            }

            throw new InvalidArgumentException('Opening hours has not be set.');
        };
    }

    public function isOpenOn()
    {
        $mixin = $this;

        return function ($day) use ($mixin) {
            $normalizeDay = $mixin->normalizeDay();

            if (isset($this)) {
                return $this->getOpeningHours()->isOpenOn($normalizeDay($day));
            }

            $getOpeningHours = $mixin->getOpeningHours();

            return $getOpeningHours()->isOpenOn($normalizeDay($day));
        };
    }

    public function isClosedOn()
    {
        $mixin = $this;

        return function ($day) use ($mixin) {
            $normalizeDay = $mixin->normalizeDay();

            if (isset($this)) {
                return $this->getOpeningHours()->isClosedOn($normalizeDay($day));
            }

            $getOpeningHours = $mixin->getOpeningHours();

            return $getOpeningHours()->isClosedOn($normalizeDay($day));
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
}
