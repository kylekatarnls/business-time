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

            if (isset($this)) {
                $this->openingHours = $convertOpeningHours($openingHours);

                return $this;
            }

            $mixin->openingHours = $convertOpeningHours($openingHours);

            return null;
        };
    }

    public function getOpeningHours()
    {
        $mixin = $this;

        return function () use ($mixin) {
            $openingHours = isset($this) ? $this->openingHours : null;

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
            if (isset($this)) {
                return $this->getOpeningHours()->isOpenOn($this->normalizeDay($day));
            }

            $getOpeningHours = $mixin->getOpeningHours();
            $normalizeDay = $mixin->normalizeDay();

            return $getOpeningHours()->isOpenOn($normalizeDay($day));
        };
    }

    public function isClosedOn()
    {
        $mixin = $this;

        return function ($day) use ($mixin) {
            if (isset($this)) {
                return $this->getOpeningHours()->isClosedOn($this->normalizeDay($day));
            }

            $getOpeningHours = $mixin->getOpeningHours();
            $normalizeDay = $mixin->normalizeDay();

            return $getOpeningHours()->isClosedOn($normalizeDay($day));
        };
    }
}
