<?php

namespace BusinessTime\Traits;

trait Holidays
{
    /**
     * Go to the next open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextOpenExcludingHolidays()
    {
        /**
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_OPEN_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Go to the next open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextBusinessOpen()
    {
        /**
         * Go to the next open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_OPEN_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Go to the previous open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function previousOpenExcludingHolidays()
    {
        /**
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::PREVIOUS_OPEN_METHOD, static::PREVIOUS_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Go to the previous open date and time that is also not an holiday.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function previousBusinessOpen()
    {
        /**
         * Go to the previous open date and time that is also not an holiday.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::PREVIOUS_OPEN_METHOD, static::PREVIOUS_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Go to the next close date and time or next holiday if sooner.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextCloseIncludingHolidays()
    {
        /**
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_CLOSE_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Go to the next close date and time or next holiday if sooner.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextBusinessClose()
    {
        /**
         * Go to the next close date and time or next holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::NEXT_CLOSE_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Go to the previous close date and time or previous holiday if sooner.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function previousCloseIncludingHolidays()
    {
        /**
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::PREVIOUS_CLOSE_METHOD, static::PREVIOUS_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Go to the previous close date and time or previous holiday if sooner.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function previousBusinessClose()
    {
        /**
         * Go to the previous close date and time or previous holiday if sooner.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getMethodLoopOnHoliday(static::PREVIOUS_CLOSE_METHOD, static::PREVIOUS_CLOSE_HOLIDAYS_METHOD);
    }
}
