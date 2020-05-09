<?php

namespace BusinessTime\Traits;

trait ClosedOr
{
    /**
     * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function closedOrNextOpenExcludingHolidays()
    {
        /**
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function closedOrNextBusinessOpen()
    {
        /**
         * Return current date-time if it's closed, else go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function closedOrPreviousBusinessOpen()
    {
        /**
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::PREVIOUS_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function closedOrPreviousOpenExcludingHolidays()
    {
        /**
         * Return current date-time if it's closed, else go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::PREVIOUS_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the next open date and time (holidays ignored if not set as exception).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function closedOrNextOpen()
    {
        /**
         * Return current date-time if it's closed, else go to the next open date and time (holidays ignored if not set as exception).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_METHOD, static::NEXT_OPEN_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the previous open date and time (holidays ignored if not set as exception).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function closedOrPreviousOpen()
    {
        /**
         * Return current date-time if it's closed, else go to the previous open date and time (holidays ignored if not set as exception).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_METHOD, static::PREVIOUS_OPEN_METHOD);
    }
}
