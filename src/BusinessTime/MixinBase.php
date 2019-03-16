<?php

namespace BusinessTime;

use Cmixin\BusinessDay;
use InvalidArgumentException;
use Spatie\OpeningHours\OpeningHours;
use SplObjectStorage;

class MixinBase extends BusinessDay
{
    const NEXT_OPEN_METHOD = 'nextOpen';
    const NEXT_CLOSE_METHOD = 'nextClose';
    const NEXT_OPEN_HOLIDAYS_METHOD = 'nextOpenExcludingHolidays';
    const NEXT_CLOSE_HOLIDAYS_METHOD = 'nextCloseIncludingHolidays';

    const HOLIDAYS_OPTION_KEY = 'holidays';
    const REGION_OPTION_KEY = 'region';
    const ADDITIONAL_HOLIDAYS_OPTION_KEY = 'with';

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

    protected static function parseHolidaysArray($holidays = null)
    {
        $region = null;

        if (is_array($holidays) && isset($holidays[static::REGION_OPTION_KEY])) {
            $region = $holidays[static::REGION_OPTION_KEY];
            unset($holidays[static::REGION_OPTION_KEY]);

            if (isset($holidays[static::ADDITIONAL_HOLIDAYS_OPTION_KEY])) {
                $holidays = $holidays[static::ADDITIONAL_HOLIDAYS_OPTION_KEY];
            }
        }

        return [$region, $holidays];
    }

    protected static function extractHolidaysFromOptions($defaultOpeningHours = null)
    {
        $region = null;
        $holidays = null;

        if (is_string($defaultOpeningHours[static::HOLIDAYS_OPTION_KEY])) {
            $region = $defaultOpeningHours[static::HOLIDAYS_OPTION_KEY];
        } elseif (is_iterable($defaultOpeningHours[static::HOLIDAYS_OPTION_KEY])) {
            [$region, $holidays] = static::parseHolidaysArray($defaultOpeningHours[static::HOLIDAYS_OPTION_KEY]);
        }

        unset($defaultOpeningHours['holidays']);

        return [$region, $holidays, $defaultOpeningHours];
    }

    protected static function getOpeningHoursOptions($defaultOpeningHours = null, array $arguments = [])
    {
        $region = null;
        $holidays = null;

        if (is_string($defaultOpeningHours)) {
            [$region, $holidays, $defaultOpeningHours] = array_pad($arguments, 3, null);
        } elseif (is_array($defaultOpeningHours) && isset($defaultOpeningHours[static::HOLIDAYS_OPTION_KEY])) {
            [$region, $holidays, $defaultOpeningHours] = static::extractHolidaysFromOptions($defaultOpeningHours);
        }

        if ($holidays && !$region) {
            $region = 'custom-holidays';
        }

        return [$region, $holidays, $defaultOpeningHours];
    }

    public static function enable($carbonClass = null, $defaultOpeningHours = null)
    {
        if ($carbonClass === null) {
            return function () {
                return true;
            };
        }

        $arguments = array_slice(func_get_args(), 1);
        [$region, $holidays, $defaultOpeningHours] = static::getOpeningHoursOptions($defaultOpeningHours, $arguments);

        $mixin = parent::enable($carbonClass);

        if ($region) {
            $carbonClass::setHolidaysRegion($region);

            if ($holidays) {
                $carbonClass::addHolidays($region, $holidays);
            }
        }

        if ($defaultOpeningHours) {
            $convertOpeningHours = $mixin->convertOpeningHours();
            static::$staticOpeningHours[$carbonClass] = $convertOpeningHours($defaultOpeningHours);
        }

        return $mixin;
    }

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

    public function getOpeningHoursStorage()
    {
        if (!static::$openingHoursStorage) {
            static::$openingHoursStorage = new SplObjectStorage();
        }

        $storage = static::$openingHoursStorage;

        return function () use ($storage) {
            return $storage;
        };
    }

    public function getOpeningHours()
    {
        $carbonClass = static::getCarbonClass();
        $staticStorage = &static::$staticOpeningHours;
        $mixin = $this;

        return function () use ($mixin, $carbonClass, &$staticStorage) {
            $openingHours = isset($this) ? (call_user_func($mixin->getOpeningHoursStorage())[$this] ?? null) : null;

            if ($openingHours = $openingHours ?: ($staticStorage[$carbonClass] ?? null)) {
                return $openingHours;
            }

            throw new InvalidArgumentException('Opening hours has not be set.');
        };
    }

    public function safeCallOnOpeningHours()
    {
        return function ($method, ...$arguments) {
            return $this->getOpeningHours()->$method(...$arguments);
        };
    }

    public function getCalleeAsMethod($callee = null)
    {
        $carbonClass = static::getCarbonClass();

        return function () use ($callee, $carbonClass) {
            if (isset($this)) {
                /* @var \Carbon\Carbon|static $this */
                return $this->setDateTimeFrom($this->safeCallOnOpeningHours($callee, clone $this));
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
