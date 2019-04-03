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

    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    /**
     * @var OpeningHours|null
     */
    public $openingHours;

    /**
     * @var SplObjectStorage
     */
    public $localOpeningHours;

    public function __construct()
    {
        $this->localOpeningHours = new SplObjectStorage();
    }

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

            return strtolower($day);
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

                foreach ($defaultOpeningHours as $key => $value) {
                    $hours[static::normalizeDay($key)] = $value;
                }

                return (new OpeningHours())->fill($hours);
            }

            throw new InvalidArgumentException('Opening hours parameter should be a '.
                OpeningHours::class.
                ' instance or an array.');
        };
    }

    private static function parseHolidaysArray($holidays = null)
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

    private static function extractHolidaysFromOptions($defaultOpeningHours = null)
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

    private static function getOpeningHoursOptions($defaultOpeningHours = null, array $arguments = [])
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

        $isArray = is_array($carbonClass);
        $carbonClasses = (array) $carbonClass;
        $mixins = array();

        foreach ($carbonClasses as $carbonClass) {
            /* @var static $mixin */
            $mixin = parent::enable($carbonClass);
            $carbonClass::mixin($mixin);

            if ($region) {
                $carbonClass::setHolidaysRegion($region);

                if ($holidays) {
                    $carbonClass::addHolidays($region, $holidays);
                }
            }

            if ($defaultOpeningHours) {
                $mixin->openingHours = $carbonClass::convertOpeningHours($defaultOpeningHours);
            }
        }

        return $isArray ? $mixins : $mixin;
    }

    public function setOpeningHours()
    {
        $mixin = $this;

        return function ($openingHours) use ($mixin, &$staticStorage) {
            if (!isset($this)) {
                $mixin->openingHours = static::convertOpeningHours($openingHours);

                return null;
            }

            $mixin->localOpeningHours[$this] = static::convertOpeningHours($openingHours);

            return $this;
        };
    }

    public function resetOpeningHours()
    {
        $mixin = $this;

        return function () use ($mixin) {
            if (!isset($this)) {
                $mixin->openingHours = null;

                return null;
            }

            unset($mixin->localOpeningHours[$this]);

            return $this;
        };
    }

    public function getOpeningHours()
    {
        $mixin = $this;

        return function () use ($mixin) {
            if (isset($this, $mixin->localOpeningHours[$this])) {
                return $mixin->localOpeningHours[$this];
            }

            if (isset($mixin->openingHours)) {
                return $mixin->openingHours;
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
        return function () use ($callee) {
            if (isset($this)) {
                /* @var \Carbon\Carbon|static $this */
                return $this->setDateTimeFrom($this->safeCallOnOpeningHours($callee, clone $this));
            }

            return static::now()->$callee();
        };
    }

    public function getMethodLoopOnHoliday($method = null, $fallbackMethod = null)
    {
        return function () use ($method, $fallbackMethod) {
            if (isset($this)) {
                $date = $this;
                do {
                    $date = $date->$method();
                } while ($date->isHoliday());

                return $date;
            }

            return static::now()->$fallbackMethod();
        };
    }
}
