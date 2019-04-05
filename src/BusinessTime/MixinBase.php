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

    const LOCAL_MODE = 'local';
    const GLOBAL_MODE = 'global';

    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    /**
     * @var \Spatie\OpeningHours\OpeningHours|null
     */
    protected $openingHours;

    /**
     * @var \SplObjectStorage<
     *                         \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface,
     *                         \Spatie\OpeningHours\OpeningHours
     *                         >
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
         * @throws \InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
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

    public static function enable($carbonClass = null, $defaultOpeningHours = null)
    {
        if ($carbonClass === null) {
            return function () {
                return true;
            };
        }

        $arguments = array_slice(func_get_args(), 1);
        [$region, $holidays, $defaultOpeningHours] = self::getOpeningHoursOptions($defaultOpeningHours, $arguments);

        $isArray = is_array($carbonClass);
        $carbonClasses = (array) $carbonClass;
        $mixins = [];

        foreach ($carbonClasses as $carbonClass) {
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
                return function ($openingHours) use ($mixin, &$staticStorage) {
                    [$region, $holidays, $openingHours] = (new DefinitionParser($mixin, $openingHours))->getSetterParameters();

                    /* @var \Spatie\OpeningHours\OpeningHours $openingHours */
                    $openingHours = static::convertOpeningHours($openingHours);

                    if ($region) {
                        $openingHours->setData([
                            $mixin::HOLIDAYS_OPTION_KEY => [
                                $mixin::REGION_OPTION_KEY => $region,
                                $mixin::ADDITIONAL_HOLIDAYS_OPTION_KEY => $holidays,
                            ],
                        ]);
                    }

                    if (isset($this)) {
                        $mixin->setOpeningHours($mixin::LOCAL_MODE, static::class, $openingHours, $this);

                        return $this;
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
                return function () use ($mixin) {
                    if (isset($this)) {
                        $mixin->resetOpeningHours($mixin::LOCAL_MODE, $this);

                        return $this;
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
                 * @throws \InvalidArgumentException if Opening hours have not be set
                 *
                 * @return \Spatie\OpeningHours\OpeningHours
                 */
                return function () use ($mixin) {
                    if (isset($this) && ($hours = $mixin->getOpeningHours($mixin::LOCAL_MODE, $this))) {
                        return $hours;
                    }

                    if ($hours = $mixin->getOpeningHours($mixin::GLOBAL_MODE)) {
                        return $hours;
                    }

                    throw new InvalidArgumentException('Opening hours have not be set.');
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
        return function ($method, ...$arguments) {
            return $this->getOpeningHours()->$method(...$arguments);
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
        return function ($method = null) use ($callee) {
            $method = is_string($method) ? $method : $callee;

            if (isset($this)) {
                /* @var \Carbon\Carbon|static $this */
                return $this->setDateTimeFrom($this->safeCallOnOpeningHours($method, clone $this));
            }

            return static::now()->$method();
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

    private static function getOpeningHoursOptions($defaultOpeningHours = null, array $arguments = [])
    {
        $region = null;
        $holidays = null;
        $parser = new DefinitionParser(static::class, $defaultOpeningHours);

        if (is_string($defaultOpeningHours)) {
            [$region, $holidays, $defaultOpeningHours] = array_pad($arguments, 3, null);
        } elseif (is_array($defaultOpeningHours) && isset($defaultOpeningHours[static::HOLIDAYS_OPTION_KEY])) {
            [$region, $holidays, $defaultOpeningHours] = $parser->extractHolidaysFromOptions($defaultOpeningHours);
        }

        $region = $parser->getRegionOrFallback($region, $holidays);

        return [$region, $holidays, $defaultOpeningHours];
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
