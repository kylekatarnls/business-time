<?php

namespace Cmixin;

use InvalidArgumentException;
use Spatie\OpeningHours\OpeningHours;

class BusinessTime extends BusinessDay
{
    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    protected static $defaultOpeningHours = null;

    protected static function convertOpeningHours($defaultOpeningHours)
    {
        if ($defaultOpeningHours instanceof OpeningHours) {
            return $defaultOpeningHours;
        }

        if (is_array($defaultOpeningHours)) {
            $hours = [];
            foreach ($defaultOpeningHours as $key => $value) {
                if (is_int($key)) {
                    $key %= 7;
                    if ($key < 0) {
                        $key += 7;
                    }
                    $key = static::$days[$key];
                }
                $hours[$key] = $value;
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
}
