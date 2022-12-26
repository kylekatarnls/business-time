<?php

namespace BusinessTime;

use BusinessTime\Exceptions\InvalidArgumentException;
use Carbon\CarbonInterface;
use Closure;
use ReflectionMethod;
use Spatie\OpeningHours\OpeningHours;

/**
 * Create a schedule that won't apply globally nor enabling macro on Carbon and can later be called
 * with any object.
 *
 * <autodoc>
 *
 * @method $this|null                                                          setOpeningHours(CarbonInterface $date, $openingHours)                                                                                                                                                                       Set the opening hours for the class/instance.
 * @method $this|null                                                          resetOpeningHours(CarbonInterface $date)                                                                                                                                                                                    Reset the opening hours for the class/instance.
 * @method \Spatie\OpeningHours\OpeningHours                                   getOpeningHours(CarbonInterface $date, $mode = null)                                                                                                                                                                        Get the opening hours of the class/instance.
 * @method mixed                                                               safeCallOnOpeningHours(CarbonInterface $date, $method, ...$arguments)                                                                                                                                                       Call a method on the OpeningHours of the current instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCalleeAsMethod(CarbonInterface $date, $method = null)                                                                   Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      getMethodLoopOnHoliday(CarbonInterface $date)                                                                              Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      getTernaryMethod(CarbonInterface $date)                                                                                                                                                                                     Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method mixed                                                               setMaxIteration(CarbonInterface $date, int $maximum)                                                                                                                                                                        Set the maximum of loop turns to run before throwing an exception where trying to add
 *                                                                                                                                                                                                                                                                                                         or subtract open/closed time.
 * @method mixed                                                               getMaxIteration(CarbonInterface $date)                                                                                                                                                                                      Get the maximum of loop turns to run before throwing an exception where trying to add
 *                                                                                                                                                                                                                                                                                                         or subtract open/closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      applyBusinessInterval(CarbonInterface $date, bool $inverted, bool $open, $interval = null, $unit = null, int $options = 0)                                                                                                  Shift current time with a given interval taking into account only open time
 *                                                                                                                                                                                                                                                                                                         (if $open is true) or only closed time (if $open is false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addBusinessInterval(CarbonInterface $date, bool $open, $interval = null, $unit = null, int $options = 0)                                                                                                                    Add the given interval taking into account only open time
 *                                                                                                                                                                                                                                                                                                         (if $open is true) or only closed time (if $open is false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subBusinessInterval(CarbonInterface $date, bool $open, $interval = null, $unit = null, int $options = 0)                                                                                                                    Add the given interval taking into account only open time
 *                                                                                                                                                                                                                                                                                                         (if $open is true) or only closed time (if $open is false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addOpenTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                                                                                        Add the given interval taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subOpenTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                                                                                        Subtract the given interval taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addClosedTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                                                                                      Add the given interval taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subClosedTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                                                                                      Subtract the given interval taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addOpenMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                                                                                               Add the given number of minutes taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subOpenMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                                                                                               Subtract the given number of minutes taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addClosedMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                                                                                             Add the given number of minutes taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subClosedMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                                                                                             Subtract the given number of minutes taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addOpenHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                                                                                                   Add the given number of hours taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subOpenHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                                                                                                   Subtract the given number of hours taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addClosedHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                                                                                                 Add the given number of hours taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subClosedHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                                                                                                 Subtract the given number of hours taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrNextOpenExcludingHolidays(CarbonInterface $date)                                                                                                                                                                    Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrNextBusinessOpen(CarbonInterface $date)                                                                                                                                                                             Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrPreviousBusinessOpen(CarbonInterface $date)                                                                                                                                                                         Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrPreviousOpenExcludingHolidays(CarbonInterface $date)                                                                                                                                                                Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrNextOpen(CarbonInterface $date)                                                                                                                                                                                     Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrPreviousOpen(CarbonInterface $date)                                                                                                                                                                                 Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextOpenExcludingHolidays(CarbonInterface $date)                                                                                                                                                                   Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextBusinessOpen(CarbonInterface $date)                                                                                                                                                                            Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousBusinessOpen(CarbonInterface $date)                                                                                                                                                                        Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousOpenExcludingHolidays(CarbonInterface $date)                                                                                                                                                               Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextCloseIncludingHolidays(CarbonInterface $date)                                                                                                                                                                  Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextBusinessClose(CarbonInterface $date)                                                                                                                                                                           Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousCloseIncludingHolidays(CarbonInterface $date)                                                                                                                                                              Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousBusinessClose(CarbonInterface $date)                                                                                                                                                                       Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextOpen(CarbonInterface $date)                                                                                                                                                                                    Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousOpen(CarbonInterface $date)                                                                                                                                                                                Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextClose(CarbonInterface $date)                                                                                                                                                                                   Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousClose(CarbonInterface $date)                                                                                                                                                                               Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\CarbonInterval|float                                        diffInBusinessUnit(CarbonInterface $date, string $unit, $date = null, int $options = 0)                                                                                                                                     Return an interval/count of given unit with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                                                                                         given date.
 * @method \Carbon\CarbonInterval                                              diffAsBusinessInterval(CarbonInterface $date, $date = null, int $options = 0)                                                                                                                                               Return an interval with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                                                                                         given date.
 * @method float                                                               diffInBusinessSeconds(CarbonInterface $date, $date = null, int $options = 0)                                                                                                                                                Return a number of seconds with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                                                                                         given date.
 * @method float                                                               diffInBusinessMinutes(CarbonInterface $date, $date = null, int $options = 0)                                                                                                                                                Return a number of minutes with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                                                                                         given date.
 * @method float                                                               diffInBusinessHours(CarbonInterface $date, $date = null, int $options = 0)                                                                                                                                                  Return a number of hours with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                                                                                         given date.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextOpenExcludingHolidays(CarbonInterface $date)                                                                           Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextBusinessOpen(CarbonInterface $date)                                                                                    Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousOpenExcludingHolidays(CarbonInterface $date)                                                                       Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousBusinessOpen(CarbonInterface $date)                                                                                Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextCloseIncludingHolidays(CarbonInterface $date)                                                                          Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextBusinessClose(CarbonInterface $date)                                                                                   Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousCloseIncludingHolidays(CarbonInterface $date)                                                                      Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousBusinessClose(CarbonInterface $date)                                                                               Loop on the current instance (or now if called statically)                                       with a given method until it's not a holiday.
 * @method bool                                                                isOpenOn(CarbonInterface $date, $day)                                                                                                                                                                                       Returns true if the business is open on a given day according to current opening hours.
 * @method bool                                                                isClosedOn(CarbonInterface $date, $day)                                                                                                                                                                                     Returns true if the business is closed on a given day according to current opening hours.
 * @method bool                                                                isOpen(CarbonInterface $date)                                                                                              Returns true if the business is open now (or current date and time)                              according to current opening hours.
 *                                                                                                                                                                                                                                                                                                         /!\ Important: it returns true if the current day is a holiday unless you set a closure handler for it in
 *                                                                                                                                                                                                                                                                                                         the exceptions setting.
 * @method bool                                                                isClosed(CarbonInterface $date)                                                                                            Returns true if the business is closed now (or current date and time)                            according to current opening hours.
 *                                                                                                                                                                                                                                                                                                         /!\ Important: it returns false if the current day is a holiday unless you set a closure handler for it in
 *                                                                                                                                                                                                                                                                                                         the exceptions setting.
 * @method bool                                                                isBusinessOpen(CarbonInterface $date)                                                                                      Returns true if the business is open and not a holiday now (or current date and time)            according to current
 *                                                                                                                                                                                                                                                                                                         opening hours.
 * @method bool                                                                isOpenExcludingHolidays(CarbonInterface $date)                                                                             Returns true if the business is open and not a holiday now (or current date and time)            according to current
 *                                                                                                                                                                                                                                                                                                         opening hours.
 * @method bool                                                                isBusinessClosed(CarbonInterface $date)                                                                                    Returns true if the business is closed or a holiday now (or current date and time)               according to current
 *                                                                                                                                                                                                                                                                                                         opening hours.
 * @method bool                                                                isClosedIncludingHolidays(CarbonInterface $date)                                                                           Returns true if the business is closed or a holiday now (or current date and time)               according to current
 *                                                                                                                                                                                                                                                                                                         opening hours.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool nextOpen(CarbonInterface $date, $method = null)                                                                            Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool nextClose(CarbonInterface $date, $method = null)                                                                           Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool previousOpen(CarbonInterface $date, $method = null)                                                                        Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool previousClose(CarbonInterface $date, $method = null)                                                                       Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrNextCloseIncludingHolidays(CarbonInterface $date)                                                                                                                                                                     Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrNextBusinessClose(CarbonInterface $date)                                                                                                                                                                              Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrPreviousCloseIncludingHolidays(CarbonInterface $date)                                                                                                                                                                 Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrPreviousBusinessClose(CarbonInterface $date)                                                                                                                                                                          Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrNextClose(CarbonInterface $date)                                                                                                                                                                                      Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrPreviousClose(CarbonInterface $date)                                                                                                                                                                                  Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                                                                                         else return the result of $method called on it.
 * @method \Spatie\OpeningHours\OpeningHoursForDay                             getCurrentDayOpeningHours(CarbonInterface $date)                                                                                                                                                                            Get OpeningHoursForDay instance of the current instance or class.
 * @method \Spatie\OpeningHours\TimeRange[]                                    getCurrentOpenTimeRanges(CarbonInterface $date)                                                                                                                                                                             Get open time ranges as array of TimeRange instances that matches the current date and time.
 * @method \Spatie\OpeningHours\TimeRange|bool                                 getCurrentOpenTimeRange(CarbonInterface $date)                                                                                                                                                                              Get current open time range as TimeRange instance or false if closed.
 * @method \Carbon\CarbonPeriod|bool                                           getCurrentOpenTimePeriod(CarbonInterface $date, $interval = null)                                                                                                                                                           Get current open time range as TimeRange instance or false if closed.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentOpenTimeRangeStart(CarbonInterface $date, $method = null)                                                        Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentOpenTimeRangeEnd(CarbonInterface $date, $method = null)                                                          Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentBusinessTimeRangeStart(CarbonInterface $date, $method = null)                                                    Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentBusinessOpenTimeRangeEnd(CarbonInterface $date, $method = null)                                                  Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                                                                                         return a date, then convert it into a Carbon/sub-class instance.
 *
 *</autodoc>
 */
final class Schedule
{
    /**
     * @var BusinessTimeWrapper
     */
    private $businessTime;

    /**
     * @var array
     */
    private $bindMacroContext = [];

    private function __construct(BusinessTimeWrapper $businessTime)
    {
        $this->businessTime = $businessTime;
    }

    public static function create(array $openingHours): self
    {
        return new self(BusinessTimeWrapper::create($openingHours));
    }

    /**
     * @param string|int $day
     *
     * @return string
     */
    public function normalizeDay($day): string
    {
        return $this->businessTime->normalizeDay()($day);
    }

    public function convertOpeningHours($defaultOpeningHours, $data = null): OpeningHours
    {
        return $this->businessTime->convertOpeningHours()($defaultOpeningHours, $data);
    }

    public function __call(string $name, array $arguments)
    {
        $closure = $this->businessTime->$name();

        if (!($closure instanceof Closure)) {
            throw new InvalidArgumentException(
                $name.' cannot be called on a '.self::class.'.'
            );
        }

        $date = array_shift($arguments);

        if (!($date instanceof CarbonInterface)) {
            throw new InvalidArgumentException(
                'First parameter must be a '.CarbonInterface::class.' instance.'
            );
        }

        if (!$date->isMutable()) {
            $date = $date->copy();
        }

        $date = $date->settings(['macros' => $this->businessTime->getMethods()]);

        return $this->callInMacroContext($date, $closure, $arguments);
    }

    private function callInMacroContext(CarbonInterface $date, Closure $closure, array $arguments)
    {
        $class = get_class($date);

        return $this->callInContext(
            $this->getBindMacroContext($class),
            $date,
            $closure->bindTo(null, $class),
            $arguments
        );
    }

    private function callInContext(
        ?ReflectionMethod $context,
        CarbonInterface $date,
        Closure $closure,
        array $arguments
    ) {
        if (!$context) {
            return $closure(...$arguments);
        }

        return $context->invoke(null, $date, static function () use ($closure, $arguments) {
            return $closure(...$arguments);
        });
    }

    private function getBindMacroContext(string $class): ?ReflectionMethod
    {
        if (array_key_exists($class, $this->bindMacroContext)) {
            return $this->bindMacroContext[$class];
        }

        $bindMacroContextMethod = $this->calculateBindMacroContext($class);
        $this->bindMacroContext[$class] = $bindMacroContextMethod;

        return $bindMacroContextMethod;
    }

    private function calculateBindMacroContext(string $class): ?ReflectionMethod
    {
        if (!method_exists($class, 'bindMacroContext')) {
            return null;
        }

        $bindMacroContextMethod = new ReflectionMethod($class, 'bindMacroContext');

        if (PHP_VERSION < 8.1) {
            $bindMacroContextMethod->setAccessible(true);
        }

        return $bindMacroContextMethod;
    }
}
