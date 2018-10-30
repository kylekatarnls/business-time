<?php

namespace Cmixin;

use InvalidArgumentException;
use Spatie\OpeningHours\OpeningHours;

class BusinessTime extends BusinessDay
{
    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    protected static $defaultOpeningHours = null;
    protected $openingHours = null;

    public static function enable($carbonClass = null, $defaultOpeningHours = null)
    {
        if ($defaultOpeningHours instanceof OpeningHours) {
            static::$defaultOpeningHours = $defaultOpeningHours;
        } elseif (is_array($defaultOpeningHours)) {
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
            static::$defaultOpeningHours = OpeningHours::create($hours);
        } elseif($defaultOpeningHours) {
            throw new InvalidArgumentException('$defaultOpeningHours parameter should be a Spatie\OpeningHours\OpeningHours instance or an array.');
        }

        return parent::enable($carbonClass);
    }
}
