<?php

namespace Carbon
{
    class Carbon
    {
        /**
         * @see \Cmixin\BusinessTime::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
        {
            // Content, see src/Cmixin/BusinessTime.php:21
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public function getCurrentOpenTimeRanges()
        {
            // Content, see src/Cmixin/BusinessTime.php:40
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/Cmixin/BusinessTime.php:59
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed or holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
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
        public function isOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
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
        public function isClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
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
        public function isOpenExcludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function isClosedIncludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
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
        public function normalizeDay($day)
        {
            // Content, see src/BusinessTime/MixinBase.php:61
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
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:94
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
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:118
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
        public function setOpeningHours($openingHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:179
        }

        /**
         * @see \BusinessTime\MixinBase::resetOpeningHours
         *
         * Reset the opening hours for the class/instance.
         *
         * @return $this|null
         */
        public function resetOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:222
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
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:260
        }

        /**
         * @see \BusinessTime\MixinBase::safeCallOnOpeningHours
         *
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        public function safeCallOnOpeningHours($method, ...$arguments)
        {
            // Content, see src/BusinessTime/MixinBase.php:288
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
        public function getCalleeAsMethod($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function getMethodLoopOnHoliday()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
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
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
        {
            // Content, see src/Cmixin/BusinessTime.php:21
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public function getCurrentOpenTimeRanges()
        {
            // Content, see src/Cmixin/BusinessTime.php:40
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/Cmixin/BusinessTime.php:59
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed or holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
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
        public function isOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
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
        public function isClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
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
        public function isOpenExcludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function isClosedIncludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
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
        public function normalizeDay($day)
        {
            // Content, see src/BusinessTime/MixinBase.php:61
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
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:94
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
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:118
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
        public function setOpeningHours($openingHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:179
        }

        /**
         * @see \BusinessTime\MixinBase::resetOpeningHours
         *
         * Reset the opening hours for the class/instance.
         *
         * @return $this|null
         */
        public function resetOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:222
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
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:260
        }

        /**
         * @see \BusinessTime\MixinBase::safeCallOnOpeningHours
         *
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        public function safeCallOnOpeningHours($method, ...$arguments)
        {
            // Content, see src/BusinessTime/MixinBase.php:288
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
        public function getCalleeAsMethod($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function getMethodLoopOnHoliday()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
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
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
        {
            // Content, see src/Cmixin/BusinessTime.php:21
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public function getCurrentOpenTimeRanges()
        {
            // Content, see src/Cmixin/BusinessTime.php:40
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/Cmixin/BusinessTime.php:59
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed or holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
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
        public function isOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
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
        public function isClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
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
        public function isOpenExcludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function isClosedIncludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
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
        public function normalizeDay($day)
        {
            // Content, see src/BusinessTime/MixinBase.php:61
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
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:94
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
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:118
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
        public function setOpeningHours($openingHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:179
        }

        /**
         * @see \BusinessTime\MixinBase::resetOpeningHours
         *
         * Reset the opening hours for the class/instance.
         *
         * @return $this|null
         */
        public function resetOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:222
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
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:260
        }

        /**
         * @see \BusinessTime\MixinBase::safeCallOnOpeningHours
         *
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        public function safeCallOnOpeningHours($method, ...$arguments)
        {
            // Content, see src/BusinessTime/MixinBase.php:288
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
        public function getCalleeAsMethod($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function getMethodLoopOnHoliday()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }
    }
}

namespace Illuminate\Support\Facades
{
    class Date
    {
        /**
         * @see \Cmixin\BusinessTime::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
        {
            // Content, see src/Cmixin/BusinessTime.php:21
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRanges
         *
         * Get open time ranges as array of TimeRange instances that matches the current date and time.
         *
         * @return \Spatie\OpeningHours\TimeRange[]
         */
        public function getCurrentOpenTimeRanges()
        {
            // Content, see src/Cmixin/BusinessTime.php:40
        }

        /**
         * @see \Cmixin\BusinessTime::getCurrentOpenTimeRange
         *
         * Get current open time range as TimeRange instance or false if closed.
         *
         * @return \Spatie\OpeningHours\TimeRange|bool
         */
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/Cmixin/BusinessTime.php:59
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed or holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentBusinessOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentBusinessOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \Cmixin\BusinessTime::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
        }

        /**
         * @see \Cmixin\BusinessTime::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
        {
            // Content, see src/Cmixin/BusinessTime.php:150
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
        public function isOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
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
        public function isClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:193
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessOpen
         *
         * Returns true if the business is open and not an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessOpen()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
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
        public function isOpenExcludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:234
        }

        /**
         * @see \Cmixin\BusinessTime::isBusinessClosed
         *
         * Returns true if the business is closed or an holiday now (or current date and time) according to current
         * opening hours.
         *
         * @return bool
         */
        public function isBusinessClosed()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function isClosedIncludingHolidays()
        {
            // Content, see src/Cmixin/BusinessTime.php:277
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
        public function nextOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function nextClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
        }

        /**
         * @see \BusinessTime\MixinBase::nextOpenExcludingHolidays
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessOpen
         *
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextCloseIncludingHolidays
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }

        /**
         * @see \BusinessTime\MixinBase::nextBusinessClose
         *
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function nextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
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
        public function normalizeDay($day)
        {
            // Content, see src/BusinessTime/MixinBase.php:61
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
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:94
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
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:118
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
        public function setOpeningHours($openingHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:179
        }

        /**
         * @see \BusinessTime\MixinBase::resetOpeningHours
         *
         * Reset the opening hours for the class/instance.
         *
         * @return $this|null
         */
        public function resetOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:222
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
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:260
        }

        /**
         * @see \BusinessTime\MixinBase::safeCallOnOpeningHours
         *
         * Call a method on the OpeningHours of the current instance.
         *
         * @return mixed
         */
        public function safeCallOnOpeningHours($method, ...$arguments)
        {
            // Content, see src/BusinessTime/MixinBase.php:288
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
        public function getCalleeAsMethod($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:314
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
        public function getMethodLoopOnHoliday()
        {
            // Content, see src/BusinessTime/MixinBase.php:353
        }
    }
}
