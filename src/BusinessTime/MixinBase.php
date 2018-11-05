<?php

namespace BusinessTime;

use Cmixin\BusinessDay;
use InvalidArgumentException;
use Spatie\OpeningHours\OpeningHours;

class MixinBase extends BusinessDay
{
    const NEXT_OPEN_METHOD = 'nextOpen';
    const NEXT_CLOSE_METHOD = 'nextClose';
    const NEXT_OPEN_HOLIDAYS_METHOD = 'nextOpenExcludingHolidays';
    const NEXT_CLOSE_HOLIDAYS_METHOD = 'nextCloseIncludingHolidays';

    protected static $staticOpeningHours = [];
    protected static $openingHoursStorage = null;
    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

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
        $normalizeDay = static::normalizeDay();

        return function ($defaultOpeningHours) use ($normalizeDay) {
            if ($defaultOpeningHours instanceof OpeningHours) {
                return $defaultOpeningHours;
            }

            if (is_array($defaultOpeningHours)) {
                $hours = [];
                foreach ($defaultOpeningHours as $key => $value) {
                    $hours[$normalizeDay($key)] = $value;
                }

                return (new OpeningHours())->fill($hours);
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
            static::$staticOpeningHours[$carbonClass] = $convertOpeningHours($defaultOpeningHours);
        }

        return $mixin;
    }

    public function safeCallOnOpeningHours()
    {
        return function ($method, ...$arguments) {
            $openingHours = $this->getOpeningHours();
            $result = $this->getOpeningHours()->$method(...$arguments);
            /** @var OpeningHours $openingHours */
            foreach ($openingHours->forWeek() as &$day) {
                foreach ($day as &$timeRange) {
                    reset($timeRange);
                }
            }

            return $result;
        };
    }

    public function getCalleeAsMethod($callee = null)
    {
        $carbonClass = static::getCarbonClass();

        return function () use ($callee, $carbonClass) {
            if (isset($this)) {
                /* @var \Carbon\Carbon|static $this */
                return $this->setDateTimeFrom($this->safeCallOnOpeningHours($callee, $this->toDateTime()));
            }

            return $carbonClass::now()->$callee();
        };
    }

    public function getMethodLoopOnHoliday($method = null, $fallbackMethod = null)
    {
        $carbonClass = static::getCarbonClass();

        return function () use ($carbonClass, $method, $fallbackMethod) {
            if (isset($this)) {
                $date = $this;
                do {
                    $date = $date->$method();
                } while ($date->isHoliday());

                return $date;
            }

            return $carbonClass::now()->$fallbackMethod();
        };
    }
}
