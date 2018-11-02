<?php

namespace Cmixin;

use InvalidArgumentException;
use Spatie\OpeningHours\OpeningHours;
use SplObjectStorage;

class BusinessTime extends BusinessDay
{
    const NEXT_OPEN_METHOD = 'nextOpen';
    const NEXT_CLOSE_METHOD = 'nextClose';
    const NEXT_OPEN_HOLIDAYS_METHOD = 'nextOpenExcludingHolidays';
    const NEXT_CLOSE_HOLIDAYS_METHOD = 'nextCloseIncludingHolidays';

    protected static $staticOpeningHoursStorage = [];
    protected static $openingHoursStorage = null;
    protected static $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    public function getOpeningHoursStorage()
    {
        if (!static::$openingHoursStorage) {
            static::$openingHoursStorage = new SplObjectStorage();
        }

        $openingHoursStorage = static::$openingHoursStorage;

        return function () use ($openingHoursStorage) {
            return $openingHoursStorage;
        };
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
            static::$staticOpeningHoursStorage[$carbonClass] = $convertOpeningHours($defaultOpeningHours);
        }

        return $mixin;
    }

    public function setOpeningHours()
    {
        $carbonClass = static::getCarbonClass();
        $staticOpeningHoursStorage = &static::$staticOpeningHoursStorage;
        $mixin = $this;

        return function ($openingHours) use ($mixin, $carbonClass, &$staticOpeningHoursStorage) {
            $convertOpeningHours = $mixin->convertOpeningHours();

            if (!isset($this)) {
                $staticOpeningHoursStorage[$carbonClass] = $convertOpeningHours($openingHours);

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
        $staticOpeningHoursStorage = &static::$staticOpeningHoursStorage;
        $mixin = $this;

        return function () use ($carbonClass, &$staticOpeningHoursStorage, $mixin) {
            if (!isset($this)) {
                unset($staticOpeningHoursStorage[$carbonClass]);

                return null;
            }

            $storage = call_user_func($mixin->getOpeningHoursStorage());
            unset($storage[$this]);

            return $this;
        };
    }

    public function getOpeningHours()
    {
        $carbonClass = static::getCarbonClass();
        $staticOpeningHoursStorage = &static::$staticOpeningHoursStorage;
        $mixin = $this;

        return function () use ($mixin, $carbonClass, &$staticOpeningHoursStorage) {
            $openingHours = isset($this) ? (call_user_func($mixin->getOpeningHoursStorage())[$this] ?? null) : null;

            if ($openingHours = $openingHours ?: ($staticOpeningHoursStorage[$carbonClass] ?? null)) {
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

    public function safeCallOnOpeningHours()
    {
        return function ($method, ...$arguments) {
            $openingHours = $this->getOpeningHours();
            $result = $this->getOpeningHours()->$method(...$arguments);
            foreach ($openingHours->forWeek() as &$day) {
                foreach ($day as &$timeRange) {
                    reset($timeRange);
                }
            }

            return $result;
        };
    }

    public function getCalleeAsMethod($callee = self::NEXT_OPEN_METHOD)
    {
        $carbonClass = static::getCarbonClass();
        $mixin = $this;

        return function () use ($callee, $mixin, $carbonClass) {
            if (isset($this)) {
                /** @var \BusinessTime\CarbonWithBusinessTimeMethods $self */
                $self = $this;

                return $self->setDateTimeFrom($self->safeCallOnOpeningHours($callee, $self->toDateTime()));
            }

            return $carbonClass::now()->$callee();
        };
    }

    public function nextOpen()
    {
        return $this->getCalleeAsMethod(static::NEXT_OPEN_METHOD);
    }

    public function nextClose()
    {
        return $this->getCalleeAsMethod(static::NEXT_CLOSE_METHOD);
    }

    public function getMethodLoopOnHoliday($method = self::NEXT_OPEN_METHOD, $fallbackMethod = self::NEXT_OPEN_HOLIDAYS_METHOD)
    {
        $carbonClass = static::getCarbonClass();
        $mixin = $this;

        return function () use ($mixin, $carbonClass, $method, $fallbackMethod) {
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

    public function nextOpenExcludingHolidays()
    {
        return $this->getMethodLoopOnHoliday(static::NEXT_OPEN_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    public function nextCloseIncludingHolidays()
    {
        return $this->getMethodLoopOnHoliday(static::NEXT_CLOSE_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }
}
