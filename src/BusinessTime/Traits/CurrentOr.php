<?php

namespace BusinessTime\Traits;

trait CurrentOr
{
    /**
     * Return current date-time if it's open, else go to the next open date
     * and time that is also not an holiday.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrNextOpenExcludingHolidays()
    {
        /**
         * Return current date-time if it's open, else go to the next open date
         * and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the next open date
     * and time that is also not an holiday.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrNextBusinessOpen()
    {
        /**
         * Return current date-time if it's open, else go to the next open date
         * and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::NEXT_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the previous open date
     * and time that is also not an holiday.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrPreviousBusinessOpen()
    {
        /**
         * Return current date-time if it's open, else go to the previous open date
         * and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::PREVIOUS_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the previous open date
     * and time that is also not an holiday.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrPreviousOpenExcludingHolidays()
    {
        /**
         * Return current date-time if it's open, else go to the previous open
         * date and time that is also not an holiday.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousOpen().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::PREVIOUS_OPEN_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the next close date
     * and time or next holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrNextCloseIncludingHolidays()
    {
        /**
         * Return current date-time if it's closed, else go to the next close date
         * and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the next close date
     * and time or next holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrNextBusinessClose()
    {
        /**
         * Return current date-time if it's closed, else go to the next close date
         * and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the previous close date
     * and time or previous holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrPreviousCloseIncludingHolidays()
    {
        /**
         * Return current date-time if it's closed, else go to the previous close date
         * and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::PREVIOUS_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the previous close date
     * and time or previous holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrPreviousBusinessClose()
    {
        /**
         * Return current date-time if it's closed, else go to the previous close date
         * and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and currentOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_HOLIDAYS_METHOD, static::PREVIOUS_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the next open date and time
     * (holidays ignored if not set as exception and holidaysAreClosed set to false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrNextOpen()
    {
        /**
         * Return current date-time if it's open, else go to the next open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_METHOD, static::NEXT_OPEN_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the previous open date and time
     * (holidays ignored if not set as exception and holidaysAreClosed set to false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrPreviousOpen()
    {
        /**
         * Return current date-time if it's open, else go to the previous open date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_METHOD, static::PREVIOUS_OPEN_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the next close date and time
     * (holidays ignored if not set as exception and holidaysAreClosed set to false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrNextClose()
    {
        /**
         * Return current date-time if it's closed, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_METHOD, static::NEXT_CLOSE_METHOD);
    }

    /**
     * Return current date-time if it's closed, else go to the previous close date and time
     * (holidays ignored if not set as exception and holidaysAreClosed set to false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function currentOrPreviousClose()
    {
        /**
         * Return current date-time if it's closed, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_CLOSED_METHOD, static::PREVIOUS_CLOSE_METHOD);
    }
}
