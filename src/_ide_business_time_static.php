<?php

namespace Carbon
{
    class Carbon
    {
        /**
         * @see \Cmixin\BusinessTime::getCurrentDayOpeningHours
         *
         * Get OpeningHours instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public static function getCurrentDayOpeningHours()
        {
            // Content, see src/Cmixin/BusinessTime.php:21
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isOpenOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:44
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isClosedOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:44
        }

        /**
         * @see \Cmixin\BusinessTime::isOpen
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:87
        }

        /**
         * @see \Cmixin\BusinessTime::isClosed
         *
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:87
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:128
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenExcludingHolidays
         *
         * @alias isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isOpenExcludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:128
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:171
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedIncludingHolidays
         *
         * @alias isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isClosedIncludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:171
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpen
         *
         * Go to the next open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::nextClose
         *
         * Go to the next close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::normalizeDay
         *
         * Returns day English name in lower case.
         *
         * @param string|int $day can be a day number, 0 is Sunday, 1 is Monday, etc. or the day name as
         *                        string with any case.
         *
         * @return string
         */
        public static function normalizeDay($day)
        {
            // Content, see src/BusinessTime/MixinBase.php:59
        }

        /**
         * @see \BusinessTime\MixinBase::convertOpeningHours
         *
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
        public static function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:92
        }

        /**
         * @see \BusinessTime\MixinBase::enable
         *
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
        public static function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:166
        }

        /**
         * @see \BusinessTime\MixinBase::setOpeningHours
         *
         * Set the opening hours for the class/instance.
         *
         * @param \Spatie\OpeningHours\OpeningHours|array $openingHours
         *
         * @return $this|null
         */
        public static function setOpeningHours($openingHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:231
        }

        /**
         * @see \BusinessTime\MixinBase::resetOpeningHours
         *
         * Reset the opening hours for the class/instance.
         *
         * @return $this|null
         */
        public static function resetOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:273
        }

        /**
         * @see \BusinessTime\MixinBase::getOpeningHours
         *
         * Get the opening hours of the class/instance.
         *
         * @throws \InvalidArgumentException if Opening hours have not be set
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public static function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:311
        }

        /**
         * @see \BusinessTime\MixinBase::safeCallOnOpeningHours
         *
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        public static function safeCallOnOpeningHours($method, ...$arguments)
        {
            // Content, see src/BusinessTime/MixinBase.php:339
        }

        /**
         * @see \BusinessTime\MixinBase::getCalleeAsMethod
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCalleeAsMethod($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::getMethodLoopOnHoliday
         *
         * Loop on the current instance (or now if called statically) with a given method until it's not an holiday.
         *
         * @param string $method
         * @param string $fallbackMethod
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getMethodLoopOnHoliday()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }
    }
}

namespace Carbon
{
    class CarbonImmutable
    {
        /**
         * @see \Cmixin\BusinessTime::getCurrentDayOpeningHours
         *
         * Get OpeningHours instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public static function getCurrentDayOpeningHours()
        {
            // Content, see src/Cmixin/BusinessTime.php:21
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isOpenOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:44
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isClosedOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:44
        }

        /**
         * @see \Cmixin\BusinessTime::isOpen
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:87
        }

        /**
         * @see \Cmixin\BusinessTime::isClosed
         *
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:87
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:128
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenExcludingHolidays
         *
         * @alias isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isOpenExcludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:128
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:171
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedIncludingHolidays
         *
         * @alias isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isClosedIncludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:171
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpen
         *
         * Go to the next open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::nextClose
         *
         * Go to the next close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::normalizeDay
         *
         * Returns day English name in lower case.
         *
         * @param string|int $day can be a day number, 0 is Sunday, 1 is Monday, etc. or the day name as
         *                        string with any case.
         *
         * @return string
         */
        public static function normalizeDay($day)
        {
            // Content, see src/BusinessTime/MixinBase.php:59
        }

        /**
         * @see \BusinessTime\MixinBase::convertOpeningHours
         *
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
        public static function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:92
        }

        /**
         * @see \BusinessTime\MixinBase::enable
         *
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
        public static function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:166
        }

        /**
         * @see \BusinessTime\MixinBase::setOpeningHours
         *
         * Set the opening hours for the class/instance.
         *
         * @param \Spatie\OpeningHours\OpeningHours|array $openingHours
         *
         * @return $this|null
         */
        public static function setOpeningHours($openingHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:231
        }

        /**
         * @see \BusinessTime\MixinBase::resetOpeningHours
         *
         * Reset the opening hours for the class/instance.
         *
         * @return $this|null
         */
        public static function resetOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:273
        }

        /**
         * @see \BusinessTime\MixinBase::getOpeningHours
         *
         * Get the opening hours of the class/instance.
         *
         * @throws \InvalidArgumentException if Opening hours have not be set
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public static function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:311
        }

        /**
         * @see \BusinessTime\MixinBase::safeCallOnOpeningHours
         *
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        public static function safeCallOnOpeningHours($method, ...$arguments)
        {
            // Content, see src/BusinessTime/MixinBase.php:339
        }

        /**
         * @see \BusinessTime\MixinBase::getCalleeAsMethod
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCalleeAsMethod($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::getMethodLoopOnHoliday
         *
         * Loop on the current instance (or now if called statically) with a given method until it's not an holiday.
         *
         * @param string $method
         * @param string $fallbackMethod
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getMethodLoopOnHoliday()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }
    }
}

namespace Illuminate\Support
{
    class Carbon
    {
        /**
         * @see \Cmixin\BusinessTime::getCurrentDayOpeningHours
         *
         * Get OpeningHours instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public static function getCurrentDayOpeningHours()
        {
            // Content, see src/Cmixin/BusinessTime.php:21
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isOpenOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:44
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isClosedOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:44
        }

        /**
         * @see \Cmixin\BusinessTime::isOpen
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:87
        }

        /**
         * @see \Cmixin\BusinessTime::isClosed
         *
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:87
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:128
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenExcludingHolidays
         *
         * @alias isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isOpenExcludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:128
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:171
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedIncludingHolidays
         *
         * @alias isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isClosedIncludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:171
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpen
         *
         * Go to the next open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::nextClose
         *
         * Go to the next close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }

        /**
         * @see \BusinessTime\MixinBase::normalizeDay
         *
         * Returns day English name in lower case.
         *
         * @param string|int $day can be a day number, 0 is Sunday, 1 is Monday, etc. or the day name as
         *                        string with any case.
         *
         * @return string
         */
        public static function normalizeDay($day)
        {
            // Content, see src/BusinessTime/MixinBase.php:59
        }

        /**
         * @see \BusinessTime\MixinBase::convertOpeningHours
         *
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
        public static function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:92
        }

        /**
         * @see \BusinessTime\MixinBase::enable
         *
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
        public static function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:166
        }

        /**
         * @see \BusinessTime\MixinBase::setOpeningHours
         *
         * Set the opening hours for the class/instance.
         *
         * @param \Spatie\OpeningHours\OpeningHours|array $openingHours
         *
         * @return $this|null
         */
        public static function setOpeningHours($openingHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:231
        }

        /**
         * @see \BusinessTime\MixinBase::resetOpeningHours
         *
         * Reset the opening hours for the class/instance.
         *
         * @return $this|null
         */
        public static function resetOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:273
        }

        /**
         * @see \BusinessTime\MixinBase::getOpeningHours
         *
         * Get the opening hours of the class/instance.
         *
         * @throws \InvalidArgumentException if Opening hours have not be set
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public static function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:311
        }

        /**
         * @see \BusinessTime\MixinBase::safeCallOnOpeningHours
         *
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        public static function safeCallOnOpeningHours($method, ...$arguments)
        {
            // Content, see src/BusinessTime/MixinBase.php:339
        }

        /**
         * @see \BusinessTime\MixinBase::getCalleeAsMethod
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCalleeAsMethod($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:364
        }

        /**
         * @see \BusinessTime\MixinBase::getMethodLoopOnHoliday
         *
         * Loop on the current instance (or now if called statically) with a given method until it's not an holiday.
         *
         * @param string $method
         * @param string $fallbackMethod
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getMethodLoopOnHoliday()
        {
            // Content, see src/BusinessTime/MixinBase.php:394
        }
    }
}
