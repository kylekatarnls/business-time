<?php

namespace BusinessTime\Traits;

trait OpenOr
{
    /**
     * Return current date-time if it's open, else go to the next close date
     * and time or next holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function openOrNextCloseIncludingHolidays()
    {
        /**
         * Return current date-time if it's open, else go to the next close date
         * and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the next close date
     * and time or next holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function openOrNextBusinessClose()
    {
        /**
         * Return current date-time if it's open, else go to the next close date
         * and time or next holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrNextClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::NEXT_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the previous close date
     * and time or previous holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function openOrPreviousCloseIncludingHolidays()
    {
        /**
         * Return current date-time if it's open, else go to the previous close date
         * and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::PREVIOUS_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the previous close date
     * and time or previous holiday if sooner.
     *
     * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function openOrPreviousBusinessClose()
    {
        /**
         * Return current date-time if it's open, else go to the previous close date
         * and time or previous holiday if sooner.
         *
         * Note than you can use the 'holidaysAreClosed' option and openOrPreviousClose().
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_HOLIDAYS_METHOD, static::PREVIOUS_CLOSE_HOLIDAYS_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the next close date and time
     * (holidays ignored if not set as exception and holidaysAreClosed set to false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function openOrNextClose()
    {
        /**
         * Return current date-time if it's open, else go to the next close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_METHOD, static::NEXT_CLOSE_METHOD);
    }

    /**
     * Return current date-time if it's open, else go to the previous close date and time
     * (holidays ignored if not set as exception and holidaysAreClosed set to false).
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function openOrPreviousClose()
    {
        /**
         * Return current date-time if it's open, else go to the previous close date and time
         * (holidays ignored if not set as exception and holidaysAreClosed set to false).
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getTernaryMethod(static::IS_OPEN_METHOD, static::PREVIOUS_CLOSE_METHOD);
    }
}
