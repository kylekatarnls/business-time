<?php

namespace BusinessTime;

use BusinessTime\Exceptions\InvalidArgumentException;
use Closure;
use Cmixin\BusinessDay;
use Spatie\OpeningHours\OpeningHours;
use SplObjectStorage;

class MixinBase extends BusinessDay
{
    const HOLIDAYS_ARE_CLOSED = 0x01;
    const USE_DAYLIGHT_SAVING_TIME = 0x02;
    const CLOSED_TIME = 0x04;
    const RELATIVE_DIFF = 0x08;
    const MAX_ITERATION = 8192;

    const HOUR_UNIT = 'hours';
    const MINUTE_UNIT = 'minutes';

    const IS_OPEN_METHOD = 'isOpen';
    const IS_CLOSED_METHOD = 'isClosed';
    const IS_OPEN_HOLIDAYS_METHOD = 'isOpenExcludingHolidays';
    const IS_CLOSED_HOLIDAYS_METHOD = 'isClosedIncludingHolidays';
    const NEXT_OPEN_METHOD = 'nextOpen';
    const NEXT_CLOSE_METHOD = 'nextClose';
    const PREVIOUS_OPEN_METHOD = 'previousOpen';
    const PREVIOUS_CLOSE_METHOD = 'previousClose';
    const NEXT_OPEN_HOLIDAYS_METHOD = 'nextOpenExcludingHolidays';
    const NEXT_CLOSE_HOLIDAYS_METHOD = 'nextCloseIncludingHolidays';
    const PREVIOUS_OPEN_HOLIDAYS_METHOD = 'previousOpenExcludingHolidays';
    const PREVIOUS_CLOSE_HOLIDAYS_METHOD = 'previousCloseIncludingHolidays';
    const CURRENT_OPEN_RANGE_START_METHOD = 'currentOpenRangeStart';
    const CURRENT_OPEN_RANGE_END_METHOD = 'currentOpenRangeEnd';

    const HOLIDAYS_OPTION_KEY = 'holidays';
    const HOLIDAYS_ARE_CLOSED_OPTION_KEY = 'holidaysAreClosed';
    const REGION_OPTION_KEY = 'region';
    const ADDITIONAL_HOLIDAYS_OPTION_KEY = 'with';

    const LOCAL_MODE = 'local';
    const GLOBAL_MODE = 'global';

    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    /**
     * @var OpeningHours|null
     */
    protected $openingHours;

    /**
     * @var SplObjectStorage<object, OpeningHours>
     */
    protected $localOpeningHours;

    public function __construct()
    {
        $this->localOpeningHours = new SplObjectStorage();
    }

    /**
     * Returns day English name in lower case.
     *
     * @return \Closure<string>
     */
    public function normalizeDay()
    {
        /**
         * Returns day English name in lower case.
         *
         * @param string|int $day can be a day number, 0 is Sunday, 1 is Monday, etc. or the day name as
         *                        string with any case.
         *
         * @return string
         */
        return static function ($day) {
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

    /**
     * Returns an OpeningHours instance (the one given if already an instance of OpeningHours, or else create
     * a new one from array definition given).
     *
     * @return \Closure<\Spatie\OpeningHours\OpeningHours>
     */
    public function convertOpeningHours()
    {
        /**
         * Returns an OpeningHours instance (the one given if already an instance of OpeningHours, or else create
         * a new one from array definition given).
         *
         * @param array|\Spatie\OpeningHours\OpeningHours $defaultOpeningHours opening hours instance or array
         *                                                                     definition
         *
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        return static function ($defaultOpeningHours, $data = null) {
            if ($defaultOpeningHours instanceof OpeningHours) {
                return $defaultOpeningHours;
            }

            if (is_array($defaultOpeningHours)) {
                $hours = ['data' => $data];

                foreach ($defaultOpeningHours as $key => $value) {
                    $hours[static::normalizeDay($key)] = $value;
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
            return static function () {
                return true;
            };
        }

        $arguments = array_slice(func_get_args(), 1);
        $isArray = is_array($carbonClass);
        $carbonClasses = (array) $carbonClass;
        $mixins = [];

        foreach ($carbonClasses as $carbonClass) {
            [$region, $holidays, $defaultOpeningHours] = self::getOpeningHoursOptions(
                $defaultOpeningHours,
                $arguments,
                function ($date) use ($carbonClass) {
                    return $carbonClass::instance($date)->isHoliday();
                }
            );

            /* @var static $mixin */
            $mixin = parent::enable($carbonClass);
            $carbonClass::mixin($mixin);
            self::setRegionAndHolidays($carbonClass, $region, $holidays);

            if ($defaultOpeningHours) {
                $mixin->openingHours = $carbonClass::convertOpeningHours($defaultOpeningHours);
            }
        }

        return $isArray ? $mixins : $mixin;
    }

    /**
     * Set the opening hours for the class/instance.
     *
     * @param string|null                            $mode
     * @param string|null                            $carbonClass
     * @param \Spatie\OpeningHours\OpeningHours|null $openingHours
     * @param \DateTimeInterface|null                $context
     *
     * @return \Closure<$this|null>|null
     */
    public function setOpeningHours($mode = null, $carbonClass = null, $openingHours = null, $context = null)
    {
        switch ($mode) {
            case static::GLOBAL_MODE:
                $this->openingHours = $openingHours;
                self::setHolidaysFromOpeningHours($carbonClass, $openingHours);

                return null;

            case static::LOCAL_MODE:
                $this->localOpeningHours[$context] = $openingHours;
                self::setHolidaysFromOpeningHours($carbonClass, $openingHours);

                return null;

            default:
                $mixin = $this;

                /**
                 * Set the opening hours for the class/instance.
                 *
                 * @param \Spatie\OpeningHours\OpeningHours|array $openingHours
                 *
                 * @return $this|null
                 */
                return static function ($openingHours) use ($mixin, &$staticStorage) {
                    $parser = new DefinitionParser($mixin, $openingHours, function ($date) {
                        return static::instance($date)->isHoliday();
                    });
                    $openingHours = $parser->getEmbeddedOpeningHours(static::class);
                    $date = end(static::$macroContextStack);

                    if ($date) {
                        $mixin->setOpeningHours($mixin::LOCAL_MODE, static::class, $openingHours, $date);

                        return $date;
                    }

                    $mixin->setOpeningHours($mixin::GLOBAL_MODE, static::class, $openingHours);

                    return null;
                };
        }
    }

    /**
     * Reset the opening hours for the class/instance.
     *
     * @return \Closure<$this|null>|null
     */
    public function resetOpeningHours($mode = null, $context = null)
    {
        switch ($mode) {
            case static::GLOBAL_MODE:
                $this->openingHours = null;

                return null;

            case static::LOCAL_MODE:
                unset($this->localOpeningHours[$context]);

                return null;

            default:
                $mixin = $this;

                /**
                 * Reset the opening hours for the class/instance.
                 *
                 * @return $this|null
                 */
                return static function () use ($mixin) {
                    $date = end(static::$macroContextStack);

                    if ($date) {
                        $mixin->resetOpeningHours($mixin::LOCAL_MODE, $date);

                        return $date;
                    }

                    $mixin->resetOpeningHours($mixin::GLOBAL_MODE);

                    return null;
                };
        }
    }

    /**
     * Get the opening hours of the class/instance.
     *
     * @return \Closure<\Spatie\OpeningHours\OpeningHours>|\Spatie\OpeningHours\OpeningHours
     */
    public function getOpeningHours($mode = null, $context = null)
    {
        switch ($mode) {
            case static::GLOBAL_MODE:
                return $this->openingHours;

            case static::LOCAL_MODE:
                return $this->localOpeningHours[$context] ?? null;

            default:
                $mixin = $this;

                /**
                 * Get the opening hours of the class/instance.
                 *
                 * @throws InvalidArgumentException if Opening hours have not been set
                 *
                 * @return \Spatie\OpeningHours\OpeningHours
                 */
                return static function ($mode = null) use ($mixin): ?OpeningHours {
                    if ((
                        (!$mode || $mode === $mixin::LOCAL_MODE) &&
                        ($date = end(static::$macroContextStack)) &&
                        ($hours = $mixin->getOpeningHours($mixin::LOCAL_MODE, $date))
                    ) ||
                        ((!$mode || $mode === $mixin::GLOBAL_MODE) && (
                            $hours = $mixin->getOpeningHours($mixin::GLOBAL_MODE)
                        ))
                    ) {
                        return $hours;
                    }

                    throw new InvalidArgumentException('Opening hours have not been set.');
                };
        }
    }

    /**
     * @internal
     *
     * Call a method on the OpeningHours of the current instance.
     *
     * @return \Closure<mixed>
     */
    public function safeCallOnOpeningHours()
    {
        /**
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        return static function ($method, ...$arguments) {
            return static::this()->getOpeningHours()->$method(...$arguments);
        };
    }

    /**
     * @internal
     *
     * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
     * return a date, then convert it into a Carbon/sub-class instance.
     *
     * @param string $callee
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function getCalleeAsMethod($callee = null)
    {
        /**
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return static function ($method = null) use ($callee) {
            $method = is_string($method) ? $method : $callee;
            $date = end(static::$macroContextStack);

            if ($date) {
                /* @var \Carbon\Carbon|static $date */
                return $date->setDateTimeFrom($date->safeCallOnOpeningHours($method, clone $date));
            }

            return static::this()->$method();
        };
    }

    /**
     * Loop on the current instance (or now if called statically) with a given method until it's not an holiday.
     *
     * @param string $method
     * @param string $fallbackMethod
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function getMethodLoopOnHoliday($method = null, $fallbackMethod = null)
    {
        /**
         * Loop on the current instance (or now if called statically) with a given method until it's not an holiday.
         *
         * @param string $method
         * @param string $fallbackMethod
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return static function () use ($method, $fallbackMethod) {
            $date = end(static::$macroContextStack);

            if ($date) {
                do {
                    $date = $date->$method();
                } while ($date->isHoliday());

                return $date;
            }

            return static::this()->$fallbackMethod();
        };
    }

    /**
     * Get a method that return current date-time if $testMethod applied on it return true,
     * else return the result of $method called on it.
     *
     * @param string $testMethod method for the condition.
     * @param string $method     method to apply if condition is false.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function getTernaryMethod($testMethod = null, $method = null)
    {
        /**
         * Get a method that return current date-time if $testMethod applied on it return true,
         * else return the result of $method called on it.
         *
         * @param string $testMethod method for the condition.
         * @param string $method     method to apply if condition is false.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return static function () use ($testMethod, $method) {
            $date = static::this();

            return $date->$testMethod() ? $date : $date->$method();
        };
    }

    private static function getOpeningHoursOptions(
        $defaultOpeningHours = null,
        array $arguments = [],
        Closure $isHoliday = null
    ) {
        return (new DefinitionParser(static::class, $defaultOpeningHours, $isHoliday))
            ->getDefinition($arguments);
    }

    private static function setRegionAndHolidays($carbonClass, $region, $holidays)
    {
        /* @var \Carbon\Carbon $carbonClass */
        if ($region) {
            $carbonClass::setHolidaysRegion($region);

            if ($holidays) {
                $carbonClass::addHolidays($region, $holidays);
            }
        }
    }

    private static function setHolidaysFromOpeningHours($carbonClass, OpeningHours $openingHours)
    {
        $data = ($openingHours->getData() ?: [])[static::HOLIDAYS_OPTION_KEY] ?? [];
        self::setRegionAndHolidays(
            $carbonClass,
            $data[static::REGION_OPTION_KEY] ?? null,
            $data[static::ADDITIONAL_HOLIDAYS_OPTION_KEY] ?? null
        );
    }
}
