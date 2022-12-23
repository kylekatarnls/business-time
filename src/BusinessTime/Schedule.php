<?php

namespace BusinessTime;

use Carbon\CarbonInterface;
use Closure;
use InvalidArgumentException;
use ReflectionMethod;
use Spatie\OpeningHours\OpeningHours;

/**
 * Create a schedule that won't apply globally nor enabling macro on Carbon and can later be called
 * with any object.
 *
 * <autodoc>
 *
 * @method $this|null                                                          setOpeningHours(CarbonInterface $date, $openingHours)                                                                                                     Set the opening hours for the class/instance.
 * @method $this|null                                                          resetOpeningHours(CarbonInterface $date)                                                                                                                  Reset the opening hours for the class/instance.
 * @method \Spatie\OpeningHours\OpeningHours                                   getOpeningHours(CarbonInterface $date, $mode = null)                                                                                                      Get the opening hours of the class/instance.
 * @method mixed                                                               safeCallOnOpeningHours(CarbonInterface $date, $method, ...$arguments)                                                                                     Call a method on the OpeningHours of the current instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      getCalleeAsMethod(CarbonInterface $date, $method = null) Get a closure to be executed on OpeningHours on the current instance (or now if called globally) that should
 *                                                                                                                                                                                                                                       return a date, then convert it into a Carbon/sub-class instance.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      getMethodLoopOnHoliday(CarbonInterface $date) Loop on the current instance (or now if called statically)                                                  with a given method until it's not an holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      getTernaryMethod(CarbonInterface $date)                                                                                                                   Get a method that return current date-time if $testMethod applied on it return true,
 *                                                                                                                                                                                                                                       else return the result of $method called on it.
 * @method mixed                                                               setMaxIteration(CarbonInterface $date, int $maximum)                                                                                                      Set the maximum of loop turns to run before throwing an exception where trying to add
 *                                                                                                                                                                                                                                       or subtract open/closed time.
 * @method mixed                                                               getMaxIteration(CarbonInterface $date)                                                                                                                    Get the maximum of loop turns to run before throwing an exception where trying to add
 *                                                                                                                                                                                                                                       or subtract open/closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      applyBusinessInterval(CarbonInterface $date, bool $inverted, bool $open, $interval = null, $unit = null, int $options = 0)                                Shift current time with a given interval taking into account only open time
 *                                                                                                                                                                                                                                       (if $open is true) or only closed time (if $open is false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addBusinessInterval(CarbonInterface $date, bool $open, $interval = null, $unit = null, int $options = 0)                                                  Add the given interval taking into account only open time
 *                                                                                                                                                                                                                                       (if $open is true) or only closed time (if $open is false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subBusinessInterval(CarbonInterface $date, bool $open, $interval = null, $unit = null, int $options = 0)                                                  Add the given interval taking into account only open time
 *                                                                                                                                                                                                                                       (if $open is true) or only closed time (if $open is false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addOpenTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                      Add the given interval taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subOpenTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                      Subtract the given interval taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addClosedTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                    Add the given interval taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subClosedTime(CarbonInterface $date, $interval = null, $unit = null, int $options = 0)                                                                    Subtract the given interval taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addOpenMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                             Add the given number of minutes taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subOpenMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                             Subtract the given number of minutes taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addClosedMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                           Add the given number of minutes taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subClosedMinutes(CarbonInterface $date, int $numberOfMinutes, int $options = 0)                                                                           Subtract the given number of minutes taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addOpenHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                                 Add the given number of hours taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subOpenHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                                 Subtract the given number of hours taking into account only open time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      addClosedHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                               Add the given number of hours taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      subClosedHours(CarbonInterface $date, int $numberOfHours, int $options = 0)                                                                               Subtract the given number of hours taking into account only closed time.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrNextOpenExcludingHolidays(CarbonInterface $date)                                                                                                  Return current date-time if it's closed, else go to the next open date
 *                                                                                                                                                                                                                                       and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrNextBusinessOpen(CarbonInterface $date)                                                                                                           Return current date-time if it's closed, else go to the next open date
 *                                                                                                                                                                                                                                       and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and closedOrNextOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrPreviousBusinessOpen(CarbonInterface $date)                                                                                                       Return current date-time if it's closed, else go to the previous open date
 *                                                                                                                                                                                                                                       and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrPreviousOpenExcludingHolidays(CarbonInterface $date)                                                                                              Return current date-time if it's closed, else go to the previous open date
 *                                                                                                                                                                                                                                       and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and closedOrPreviousOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrNextOpen(CarbonInterface $date)                                                                                                                   Return current date-time if it's closed, else go to the next open date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      closedOrPreviousOpen(CarbonInterface $date)                                                                                                               Return current date-time if it's closed, else go to the previous open date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextOpenExcludingHolidays(CarbonInterface $date)                                                                                                 Return current date-time if it's open, else go to the next open date
 *                                                                                                                                                                                                                                       and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextBusinessOpen(CarbonInterface $date)                                                                                                          Return current date-time if it's open, else go to the next open date
 *                                                                                                                                                                                                                                       and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousBusinessOpen(CarbonInterface $date)                                                                                                      Return current date-time if it's open, else go to the previous open date
 *                                                                                                                                                                                                                                       and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousOpenExcludingHolidays(CarbonInterface $date)                                                                                             Return current date-time if it's open, else go to the previous open
 *                                                                                                                                                                                                                                       date and time that is also not an holiday.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextCloseIncludingHolidays(CarbonInterface $date)                                                                                                Return current date-time if it's closed, else go to the next close date
 *                                                                                                                                                                                                                                       and time or next holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextBusinessClose(CarbonInterface $date)                                                                                                         Return current date-time if it's closed, else go to the next close date
 *                                                                                                                                                                                                                                       and time or next holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousCloseIncludingHolidays(CarbonInterface $date)                                                                                            Return current date-time if it's closed, else go to the previous close date
 *                                                                                                                                                                                                                                       and time or previous holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousBusinessClose(CarbonInterface $date)                                                                                                     Return current date-time if it's closed, else go to the previous close date
 *                                                                                                                                                                                                                                       and time or previous holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextOpen(CarbonInterface $date)                                                                                                                  Return current date-time if it's open, else go to the next open date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousOpen(CarbonInterface $date)                                                                                                              Return current date-time if it's open, else go to the previous open date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrNextClose(CarbonInterface $date)                                                                                                                 Return current date-time if it's closed, else go to the next close date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      currentOrPreviousClose(CarbonInterface $date)                                                                                                             Return current date-time if it's closed, else go to the previous close date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Carbon\CarbonInterval|float                                        diffInBusinessUnit(CarbonInterface $date, string $unit, $date = null, int $options = 0)                                                                   Return an interval/count of given unit with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                       given date.
 * @method \Carbon\CarbonInterval                                              diffAsBusinessInterval(CarbonInterface $date, $date = null, int $options = 0)                                                                             Return an interval with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                       given date.
 * @method float                                                               diffInBusinessSeconds(CarbonInterface $date, $date = null, int $options = 0)                                                                              Return a number of seconds with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                       given date.
 * @method float                                                               diffInBusinessMinutes(CarbonInterface $date, $date = null, int $options = 0)                                                                              Return a number of minutes with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                       given date.
 * @method float                                                               diffInBusinessHours(CarbonInterface $date, $date = null, int $options = 0)                                                                                Return a number of hours with open/closed business time between the current date and an other
 *                                                                                                                                                                                                                                       given date.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextOpenExcludingHolidays(CarbonInterface $date)                                                                                                          Go to the next open date and time that is also not an holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextBusinessOpen(CarbonInterface $date)                                                                                                                   Go to the next open date and time that is also not an holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousOpenExcludingHolidays(CarbonInterface $date)                                                                                                      Go to the previous open date and time that is also not an holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousBusinessOpen(CarbonInterface $date)                                                                                                               Go to the previous open date and time that is also not an holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextCloseIncludingHolidays(CarbonInterface $date)                                                                                                         Go to the next close date and time or next holiday if sooner.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextBusinessClose(CarbonInterface $date)                                                                                                                  Go to the next close date and time or next holiday if sooner.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousCloseIncludingHolidays(CarbonInterface $date)                                                                                                     Go to the previous close date and time or previous holiday if sooner.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousBusinessClose(CarbonInterface $date)                                                                                                              Go to the previous close date and time or previous holiday if sooner.
 * @method bool                                                                isOpenOn(CarbonInterface $date, $day)                                                                                                                     Returns true if the business is open on a given day according to current opening hours.
 * @method bool                                                                isClosedOn(CarbonInterface $date, $day)                                                                                                                   Returns true if the business is closed on a given day according to current opening hours.
 * @method bool                                                                isOpen(CarbonInterface $date) Returns true if the business is open now (or current date and time)                                                         according to current opening hours.
 *                                                                                                                                                                                                                                       /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
 *                                                                                                                                                                                                                                       the exceptions setting.
 * @method bool                                                                isClosed(CarbonInterface $date) Returns true if the business is closed now (or current date and time)                                                     according to current opening hours.
 *                                                                                                                                                                                                                                       /!\ Important: it returns false if the current day is an holiday unless you set a closure handler for it in
 *                                                                                                                                                                                                                                       the exceptions setting.
 * @method bool                                                                isBusinessOpen(CarbonInterface $date) Returns true if the business is open and not an holiday now (or current date and time)                              according to current
 *                                                                                                                                                                                                                                       opening hours.
 * @method bool                                                                isOpenExcludingHolidays(CarbonInterface $date) Returns true if the business is open and not an holiday now (or current date and time)                     according to current
 *                                                                                                                                                                                                                                       opening hours.
 * @method bool                                                                isBusinessClosed(CarbonInterface $date) Returns true if the business is closed or an holiday now (or current date and time)                               according to current
 *                                                                                                                                                                                                                                       opening hours.
 * @method bool                                                                isClosedIncludingHolidays(CarbonInterface $date) Returns true if the business is closed or an holiday now (or current date and time)                      according to current
 *                                                                                                                                                                                                                                       opening hours.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextOpen(CarbonInterface $date, $method = null)                                                                                                           Go to the next open date and time.
 *                                                                                                                                                                                                                                       /!\ Important: holidays are assumed open unless you set a closure handler for it in the
 *                                                                                                                                                                                                                                       exceptions setting.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      nextClose(CarbonInterface $date, $method = null)                                                                                                          Go to the next close date and time.
 *                                                                                                                                                                                                                                       /!\ Important: holidays are assumed open unless you set a closure handler for it in the
 *                                                                                                                                                                                                                                       exceptions setting.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousOpen(CarbonInterface $date, $method = null)                                                                                                       Go to the previous open date and time.
 *                                                                                                                                                                                                                                       /!\ Important: holidays are assumed open unless you set a closure handler for it in the
 *                                                                                                                                                                                                                                       exceptions setting.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      previousClose(CarbonInterface $date, $method = null)                                                                                                      Go to the previous close date and time.
 *                                                                                                                                                                                                                                       /!\ Important: holidays are assumed open unless you set a closure handler for it in the
 *                                                                                                                                                                                                                                       exceptions setting.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrNextCloseIncludingHolidays(CarbonInterface $date)                                                                                                   Return current date-time if it's open, else go to the next close date
 *                                                                                                                                                                                                                                       and time or next holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrNextBusinessClose(CarbonInterface $date)                                                                                                            Return current date-time if it's open, else go to the next close date
 *                                                                                                                                                                                                                                       and time or next holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrPreviousCloseIncludingHolidays(CarbonInterface $date)                                                                                               Return current date-time if it's open, else go to the previous close date
 *                                                                                                                                                                                                                                       and time or previous holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrPreviousBusinessClose(CarbonInterface $date)                                                                                                        Return current date-time if it's open, else go to the previous close date
 *                                                                                                                                                                                                                                       and time or previous holiday if sooner.
 *                                                                                                                                                                                                                                       Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrNextClose(CarbonInterface $date)                                                                                                                    Return current date-time if it's open, else go to the next close date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface      openOrPreviousClose(CarbonInterface $date)                                                                                                                Return current date-time if it's open, else go to the previous close date and time
 *                                                                                                                                                                                                                                       (holidays ignored if not set as exception and holidaysAreClosed set to false).
 * @method \Spatie\OpeningHours\OpeningHoursForDay                             getCurrentDayOpeningHours(CarbonInterface $date)                                                                                                          Get OpeningHoursForDay instance of the current instance or class.
 * @method \Spatie\OpeningHours\TimeRange[]                                    getCurrentOpenTimeRanges(CarbonInterface $date)                                                                                                           Get open time ranges as array of TimeRange instances that matches the current date and time.
 * @method \Spatie\OpeningHours\TimeRange|bool                                 getCurrentOpenTimeRange(CarbonInterface $date)                                                                                                            Get current open time range as TimeRange instance or false if closed.
 * @method \Carbon\CarbonPeriod|bool                                           getCurrentOpenTimePeriod(CarbonInterface $date, $interval = null)                                                                                         Get current open time range as TimeRange instance or false if closed.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentOpenTimeRangeStart(CarbonInterface $date, $method = null)                                                                                       Get current open time range start as Carbon instance or false if closed.
 *                                                                                                                                                                                                                                       /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
 *                                                                                                                                                                                                                                       the exceptions setting.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentOpenTimeRangeEnd(CarbonInterface $date, $method = null)                                                                                         Get current open time range end as Carbon instance or false if closed.
 *                                                                                                                                                                                                                                       /!\ Important: it returns true if the current day is an holiday unless you set a closure handler for it in
 *                                                                                                                                                                                                                                       the exceptions setting.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentBusinessTimeRangeStart(CarbonInterface $date, $method = null)                                                                                   Get current open time range start as Carbon instance or false if closed or holiday.
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface|bool getCurrentBusinessOpenTimeRangeEnd(CarbonInterface $date, $method = null)                                                                                 Get current open time range end as Carbon instance or false if closed.
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

    public function normalizeDay(string $day): string
    {
        return $this->businessTime->normalizeDay()($day);
    }

    public function convertOpeningHours($defaultOpeningHours, $data = null): OpeningHours
    {
        return $this->businessTime->convertOpeningHours()($defaultOpeningHours, $data);
    }

    public function __call($name, $arguments)
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
        $class = get_class($date);
        $bindMacroContext = $this->getBindMacroContext($class);
        $closure = $closure->bindTo(null, $class);

        if (!$bindMacroContext) {
            return $closure(...$arguments);
        }

        return $bindMacroContext->invoke(null, $date, static function () use ($closure, $arguments) {
            return $closure(...$arguments);
        });
    }

    private function getBindMacroContext(string $class): ?ReflectionMethod
    {
        if (array_key_exists($class, $this->bindMacroContext)) {
            return $this->bindMacroContext[$class];
        }

        $bindMacroContext = $this->calculateBindMacroContext($class);
        $this->bindMacroContext[$class] = $bindMacroContext;

        return $bindMacroContext;
    }

    private function calculateBindMacroContext(string $class): ?ReflectionMethod
    {
        if (!method_exists($class, 'bindMacroContext')) {
            return null;
        }

        $bindMacroContext = new ReflectionMethod($class, 'bindMacroContext');

        if (PHP_VERSION < 8.1) {
            $bindMacroContext->setAccessible(true);
        }

        return $bindMacroContext;
    }
}
