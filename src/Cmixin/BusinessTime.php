<?php

namespace Cmixin;

use InvalidArgumentException;
use Spatie\OpeningHours\OpeningHours;

class BusinessTime extends BusinessDay
{
    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    protected static $defaultOpeningHours = null;

    public static function normalizeDay($day)
    {
        if (is_int($day)) {
            $day %= 7;
            if ($day < 0) {
                $day += 7;
            }

            return static::$days[$day];
        }

        return $day;
    }

    protected static function convertOpeningHours($defaultOpeningHours)
    {
        if ($defaultOpeningHours instanceof OpeningHours) {
            return $defaultOpeningHours;
        }

        if (is_array($defaultOpeningHours)) {
            $hours = [];
            foreach ($defaultOpeningHours as $key => $value) {
                $hours[static::normalizeDay($key)] = $value;
            }
            return OpeningHours::create($hours);
        }

        throw new InvalidArgumentException('Opening hours parameter should be a Spatie\OpeningHours\OpeningHours instance or an array.');
    }

    public static function setDefaultOpeningHours($defaultOpeningHours)
    {
        static::$defaultOpeningHours = static::convertOpeningHours($defaultOpeningHours);
    }

    public static function enable($carbonClass = null, $defaultOpeningHours = null)
    {
        if($defaultOpeningHours) {
            static::setDefaultOpeningHours($defaultOpeningHours);
        }

        return parent::enable($carbonClass);
    }

    public function setOpeningHours()
    {
        return function ($openingHours) {
            $this->openingHours = static::convertOpeningHours($openingHours);

            return $this;
        };
    }

    public function getOpeningHours()
    {
        return function () {
            if ($openingHours = $this->openingHours ?? static::$defaultOpeningHours) {
                return $openingHours;
            }

            throw new InvalidArgumentException('Opening hours has not be set.');
        };
    }

    public static function retrieveOpeningHours($date)
    {
        if ($date) {
            return $date->getOpeningHours();
        }

        return static::$defaultOpeningHours;
    }

    public function isOpenOn()
    {
        return function ($day) {
            return $this->getOpeningHours()->isOpenOn(static::normalizeDay($day));
        };
    }

    public function isClosedOn()
    {
        return function ($day) {
            return $this->getOpeningHours()->isClosedOn(static::normalizeDay($day));
        };
    }
}
