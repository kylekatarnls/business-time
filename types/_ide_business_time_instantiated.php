<?php

namespace Carbon
{
    class Carbon
    {
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
            // Content, see src/BusinessTime/MixinBase.php:73
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:106
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:130
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
            // Content, see src/BusinessTime/MixinBase.php:191
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
            // Content, see src/BusinessTime/MixinBase.php:234
        }

        /**
         * @see \BusinessTime\MixinBase::getOpeningHours
         *
         * Get the opening hours of the class/instance.
         *
         * @throws InvalidArgumentException if Opening hours have not been set
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:272
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
            // Content, see src/BusinessTime/MixinBase.php:300
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::getTernaryMethod
         *
         * Get a method that return current date-time if $testMethod applied on it return true,
         * else return the result of $method called on it.
         *
         * @param string $testMethod method for the condition.
         * @param string $method     method to apply if condition is false.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function getTernaryMethod()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::setMaxIteration
         *
         * Set the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function setMaxIteration(int $maxIteration)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:34
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::getMaxIteration
         *
         * Get the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function getMaxIteration()
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:57
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::applyBusinessInterval
         *
         * Shift current time with a given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $inverted subtract the interval if set to true.
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function applyBusinessInterval(bool $inverted, bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:84
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:168
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:195
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenTime
         *
         * Add the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:219
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenTime
         *
         * Subtract the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:243
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedTime
         *
         * Add the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:267
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedTime
         *
         * Subtract the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:291
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenMinutes
         *
         * Add the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:314
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenMinutes
         *
         * Subtract the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:337
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedMinutes
         *
         * Add the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:360
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedMinutes
         *
         * Subtract the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:383
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenHours
         *
         * Add the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:406
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenHours
         *
         * Subtract the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:429
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedHours
         *
         * Add the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:452
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedHours
         *
         * Subtract the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:475
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextBusinessOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousBusinessOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessOpen
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessClose
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpen
         *
         * Return current date-time if it's open, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextClose
         *
         * Return current date-time if it's closed, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
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
        public function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public function isClosed()
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
        public function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
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
        public function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
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
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Go to the previous open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Go to the previous close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextBusinessClose
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousBusinessClose
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextClose
         *
         * Return current date-time if it's open, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousClose
         *
         * Return current date-time if it's open, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
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
        public function getCurrentOpenTimeRanges()
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
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }
    }
}

namespace Carbon
{
    class CarbonImmutable
    {
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
            // Content, see src/BusinessTime/MixinBase.php:73
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:106
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:130
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
            // Content, see src/BusinessTime/MixinBase.php:191
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
            // Content, see src/BusinessTime/MixinBase.php:234
        }

        /**
         * @see \BusinessTime\MixinBase::getOpeningHours
         *
         * Get the opening hours of the class/instance.
         *
         * @throws InvalidArgumentException if Opening hours have not been set
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:272
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
            // Content, see src/BusinessTime/MixinBase.php:300
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::getTernaryMethod
         *
         * Get a method that return current date-time if $testMethod applied on it return true,
         * else return the result of $method called on it.
         *
         * @param string $testMethod method for the condition.
         * @param string $method     method to apply if condition is false.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function getTernaryMethod()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::setMaxIteration
         *
         * Set the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function setMaxIteration(int $maxIteration)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:34
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::getMaxIteration
         *
         * Get the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function getMaxIteration()
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:57
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::applyBusinessInterval
         *
         * Shift current time with a given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $inverted subtract the interval if set to true.
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function applyBusinessInterval(bool $inverted, bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:84
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:168
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:195
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenTime
         *
         * Add the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:219
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenTime
         *
         * Subtract the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:243
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedTime
         *
         * Add the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:267
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedTime
         *
         * Subtract the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:291
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenMinutes
         *
         * Add the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:314
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenMinutes
         *
         * Subtract the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:337
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedMinutes
         *
         * Add the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:360
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedMinutes
         *
         * Subtract the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:383
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenHours
         *
         * Add the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:406
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenHours
         *
         * Subtract the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:429
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedHours
         *
         * Add the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:452
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedHours
         *
         * Subtract the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:475
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextBusinessOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousBusinessOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessOpen
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessClose
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpen
         *
         * Return current date-time if it's open, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextClose
         *
         * Return current date-time if it's closed, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
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
        public function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public function isClosed()
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
        public function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
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
        public function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
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
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Go to the previous open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Go to the previous close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextBusinessClose
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousBusinessClose
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextClose
         *
         * Return current date-time if it's open, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousClose
         *
         * Return current date-time if it's open, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
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
        public function getCurrentOpenTimeRanges()
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
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }
    }
}

namespace Illuminate\Support
{
    class Carbon
    {
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
            // Content, see src/BusinessTime/MixinBase.php:73
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:106
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:130
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
            // Content, see src/BusinessTime/MixinBase.php:191
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
            // Content, see src/BusinessTime/MixinBase.php:234
        }

        /**
         * @see \BusinessTime\MixinBase::getOpeningHours
         *
         * Get the opening hours of the class/instance.
         *
         * @throws InvalidArgumentException if Opening hours have not been set
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:272
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
            // Content, see src/BusinessTime/MixinBase.php:300
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::getTernaryMethod
         *
         * Get a method that return current date-time if $testMethod applied on it return true,
         * else return the result of $method called on it.
         *
         * @param string $testMethod method for the condition.
         * @param string $method     method to apply if condition is false.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function getTernaryMethod()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::setMaxIteration
         *
         * Set the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function setMaxIteration(int $maxIteration)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:34
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::getMaxIteration
         *
         * Get the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function getMaxIteration()
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:57
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::applyBusinessInterval
         *
         * Shift current time with a given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $inverted subtract the interval if set to true.
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function applyBusinessInterval(bool $inverted, bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:84
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:168
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:195
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenTime
         *
         * Add the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:219
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenTime
         *
         * Subtract the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:243
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedTime
         *
         * Add the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:267
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedTime
         *
         * Subtract the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:291
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenMinutes
         *
         * Add the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:314
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenMinutes
         *
         * Subtract the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:337
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedMinutes
         *
         * Add the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:360
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedMinutes
         *
         * Subtract the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:383
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenHours
         *
         * Add the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:406
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenHours
         *
         * Subtract the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:429
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedHours
         *
         * Add the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:452
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedHours
         *
         * Subtract the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:475
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextBusinessOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousBusinessOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessOpen
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessClose
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpen
         *
         * Return current date-time if it's open, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextClose
         *
         * Return current date-time if it's closed, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
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
        public function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public function isClosed()
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
        public function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
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
        public function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
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
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Go to the previous open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Go to the previous close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextBusinessClose
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousBusinessClose
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextClose
         *
         * Return current date-time if it's open, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousClose
         *
         * Return current date-time if it's open, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
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
        public function getCurrentOpenTimeRanges()
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
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }
    }
}

namespace Illuminate\Support\Facades
{
    class Date
    {
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
            // Content, see src/BusinessTime/MixinBase.php:73
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function convertOpeningHours($defaultOpeningHours)
        {
            // Content, see src/BusinessTime/MixinBase.php:106
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
         * @throws InvalidArgumentException if $defaultOpeningHours has an invalid type
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function enable()
        {
            // Content, see src/BusinessTime/MixinBase.php:130
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
            // Content, see src/BusinessTime/MixinBase.php:191
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
            // Content, see src/BusinessTime/MixinBase.php:234
        }

        /**
         * @see \BusinessTime\MixinBase::getOpeningHours
         *
         * Get the opening hours of the class/instance.
         *
         * @throws InvalidArgumentException if Opening hours have not been set
         *
         * @return \Spatie\OpeningHours\OpeningHours
         */
        public function getOpeningHours()
        {
            // Content, see src/BusinessTime/MixinBase.php:272
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
            // Content, see src/BusinessTime/MixinBase.php:300
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::getTernaryMethod
         *
         * Get a method that return current date-time if $testMethod applied on it return true,
         * else return the result of $method called on it.
         *
         * @param string $testMethod method for the condition.
         * @param string $method     method to apply if condition is false.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function getTernaryMethod()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::setMaxIteration
         *
         * Set the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function setMaxIteration(int $maxIteration)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:34
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::getMaxIteration
         *
         * Get the maximum of loop turns to run before throwing an exception where trying to add
         * or subtract open/closed time.
         */
        public function getMaxIteration()
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:57
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::applyBusinessInterval
         *
         * Shift current time with a given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $inverted subtract the interval if set to true.
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function applyBusinessInterval(bool $inverted, bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:84
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:168
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subBusinessInterval
         *
         * Add the given interval taking into account only open time
         * (if $open is true) or only closed time (if $open is false).
         *
         * @param bool                          $open     take only open time into account if true, only closed time else.
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subBusinessInterval(bool $open, $interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:195
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenTime
         *
         * Add the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:219
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenTime
         *
         * Subtract the given interval taking into account only open time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:243
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedTime
         *
         * Add the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:267
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedTime
         *
         * Subtract the given interval taking into account only closed time.
         *
         * @param int|\DateInterval|string|null $interval period default interval or number of the given $unit.
         * @param string|null                   $unit     if specified, $interval must be an integer.
         * @param int                           $options  options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedTime($interval = null, $unit = null, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:291
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenMinutes
         *
         * Add the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:314
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenMinutes
         *
         * Subtract the given number of minutes taking into account only open time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:337
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedMinutes
         *
         * Add the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:360
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedMinutes
         *
         * Subtract the given number of minutes taking into account only closed time.
         *
         * @param int $numberOfMinutes number of minutes (in open hours).
         * @param int $options         options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedMinutes(int $numberOfMinutes, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:383
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addOpenHours
         *
         * Add the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:406
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subOpenHours
         *
         * Subtract the given number of hours taking into account only open time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subOpenHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:429
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::addClosedHours
         *
         * Add the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function addClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:452
        }

        /**
         * @see \BusinessTime\Traits\AddAndSubtract::subClosedHours
         *
         * Subtract the given number of hours taking into account only closed time.
         *
         * @param int $numberOfHours number of open hours.
         * @param int $options       options (as bytes-union) such as BusinessTime::HOLIDAYS_ARE_CLOSED
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function subClosedHours(int $numberOfHours, int $options = 0)
        {
            // Content, see src/BusinessTime/Traits/AddAndSubtract.php:475
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextBusinessOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousBusinessOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrNextOpen
         *
         * Return current date-time if it's closed, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::closedOrPreviousOpen
         *
         * Return current date-time if it's closed, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function closedOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessOpen
         *
         * Return current date-time if it's open, else go to the next open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpenExcludingHolidays
         *
         * Return current date-time if it's open, else go to the previous open date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextBusinessClose
         *
         * Return current date-time if it's closed, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousBusinessClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextOpen
         *
         * Return current date-time if it's open, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousOpen
         *
         * Return current date-time if it's open, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrNextClose
         *
         * Return current date-time if it's closed, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::currentOrPreviousClose
         *
         * Return current date-time if it's closed, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function currentOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpenExcludingHolidays
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpenExcludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessOpen
         *
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessOpen()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
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
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousCloseIncludingHolidays
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\MixinBase::previousBusinessClose
         *
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:356
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenOn
         *
         * Returns true if the business is open on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isOpenOn($day)
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:23
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedOn
         *
         * Returns true if the business is closed on a given day according to current opening hours.
         *
         * @return bool
         */
        public function isClosedOn($day)
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
        public function isOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:66
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosed
         *
         * Returns true if the business is closed now (or current date and time) according to current opening hours.
         * /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return bool
         */
        public function isClosed()
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
        public function isBusinessOpen()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:107
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isOpenExcludingHolidays
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
        public function isBusinessClosed()
        {
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
        }

        /**
         * @see \BusinessTime\Traits\IsMethods::isClosedIncludingHolidays
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
            // Content, see src/BusinessTime/Traits/IsMethods.php:150
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousOpen
         *
         * Go to the previous open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousOpen($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::previousClose
         *
         * Go to the previous close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function previousClose($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextBusinessClose
         *
         * Return current date-time if it's open, else go to the next close date and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousCloseIncludingHolidays
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousCloseIncludingHolidays()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousBusinessClose
         *
         * Return current date-time if it's open, else go to the previous close date and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousBusinessClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrNextClose
         *
         * Return current date-time if it's open, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrNextClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\MixinBase::openOrPreviousClose
         *
         * Return current date-time if it's open, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        public function openOrPreviousClose()
        {
            // Content, see src/BusinessTime/MixinBase.php:391
        }

        /**
         * @see \BusinessTime\Traits\Range::getCurrentDayOpeningHours
         *
         * Get OpeningHoursForDay instance of the current instance or class.
         *
         * @return \Spatie\OpeningHours\OpeningHoursForDay
         */
        public function getCurrentDayOpeningHours()
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
        public function getCurrentOpenTimeRanges()
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
        public function getCurrentOpenTimeRange()
        {
            // Content, see src/BusinessTime/Traits/Range.php:61
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeStart
         *
         * Get current open time range start as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeStart($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
        }

        /**
         * @see \BusinessTime\MixinBase::getCurrentOpenTimeRangeEnd
         *
         * Get current open time range end as Carbon instance or false if closed.
         * /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
         * the exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool
         */
        public function getCurrentOpenTimeRangeEnd($method = null)
        {
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
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
            // Content, see src/BusinessTime/MixinBase.php:325
        }
    }
}
