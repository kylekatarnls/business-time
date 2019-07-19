<?php

namespace Carbon
{
    class Carbon
    {
        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:65
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
            // Content, see src/BusinessTime/MixinBase.php:98
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
            // Content, see src/BusinessTime/MixinBase.php:122
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
            // Content, see src/BusinessTime/MixinBase.php:183
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
            // Content, see src/BusinessTime/MixinBase.php:226
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
            // Content, see src/BusinessTime/MixinBase.php:264
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
            // Content, see src/BusinessTime/MixinBase.php:292
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
            // Content, see src/BusinessTime/MixinBase.php:317
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public static function getCurrentDayOpeningHours()
        {
            // Content, see src/BusinessTime/Traits/Range.php:21
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public static function getCurrentOpenTimeRanges()
        {
            // Content, see src/BusinessTime/Traits/Range.php:41
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public static function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isClosedOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpen
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isClosedIncludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::nextClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }
    }
}

namespace Carbon
{
    class CarbonImmutable
    {
        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:65
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
            // Content, see src/BusinessTime/MixinBase.php:98
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
            // Content, see src/BusinessTime/MixinBase.php:122
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
            // Content, see src/BusinessTime/MixinBase.php:183
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
            // Content, see src/BusinessTime/MixinBase.php:226
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
            // Content, see src/BusinessTime/MixinBase.php:264
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
            // Content, see src/BusinessTime/MixinBase.php:292
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
            // Content, see src/BusinessTime/MixinBase.php:317
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public static function getCurrentDayOpeningHours()
        {
            // Content, see src/BusinessTime/Traits/Range.php:21
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public static function getCurrentOpenTimeRanges()
        {
            // Content, see src/BusinessTime/Traits/Range.php:41
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public static function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isClosedOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpen
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isClosedIncludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::nextClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }
    }
}

namespace Illuminate\Support
{
    class Carbon
    {
        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:65
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
            // Content, see src/BusinessTime/MixinBase.php:98
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
            // Content, see src/BusinessTime/MixinBase.php:122
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
            // Content, see src/BusinessTime/MixinBase.php:183
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
            // Content, see src/BusinessTime/MixinBase.php:226
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
            // Content, see src/BusinessTime/MixinBase.php:264
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
            // Content, see src/BusinessTime/MixinBase.php:292
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
            // Content, see src/BusinessTime/MixinBase.php:317
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public static function getCurrentDayOpeningHours()
        {
            // Content, see src/BusinessTime/Traits/Range.php:21
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public static function getCurrentOpenTimeRanges()
        {
            // Content, see src/BusinessTime/Traits/Range.php:41
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public static function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isClosedOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpen
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isClosedIncludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::nextClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }
    }
}

namespace Illuminate\Support\Facades
{
    class Date
    {
        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:348
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
            // Content, see src/BusinessTime/MixinBase.php:65
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
            // Content, see src/BusinessTime/MixinBase.php:98
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
            // Content, see src/BusinessTime/MixinBase.php:122
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
            // Content, see src/BusinessTime/MixinBase.php:183
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
            // Content, see src/BusinessTime/MixinBase.php:226
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
            // Content, see src/BusinessTime/MixinBase.php:264
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
            // Content, see src/BusinessTime/MixinBase.php:292
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
            // Content, see src/BusinessTime/MixinBase.php:317
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
            // Content, see src/BusinessTime/MixinBase.php:348
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public static function getCurrentDayOpeningHours()
        {
            // Content, see src/BusinessTime/Traits/Range.php:21
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public static function getCurrentOpenTimeRanges()
        {
            // Content, see src/BusinessTime/Traits/Range.php:41
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public static function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public static function isClosedOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpen
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is open now (or current date and time) according to current opening hours.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public static function isClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public static function isClosedIncludingHolidays()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::nextClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
         * return a date, then convert it into a Carbon/sub-class instance.
         *
         * @param string $method
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public static function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:317
        }
    }
}
