<?php

namespace BusinessTime\Traits;

trait OpenClose
{
    /**
     * Go to the next open date and time.
     * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextOpen()
    {
        /**
         * Go to the next open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getCalleeAsMethod(static::NEXT_OPEN_METHOD);
    }

    /**
     * Go to the next close date and time.
     * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function nextClose()
    {
        /**
         * Go to the next close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getCalleeAsMethod(static::NEXT_CLOSE_METHOD);
    }

    /**
     * Go to the previous open date and time.
     * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function previousOpen()
    {
        /**
         * Go to the previous open date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getCalleeAsMethod(static::PREVIOUS_OPEN_METHOD);
    }

    /**
     * Go to the previous close date and time.
     * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
     * exceptions setting.
     *
     * @return \Closure<\Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface>
     */
    public function previousClose()
    {
        /**
         * Go to the previous close date and time.
         * /!\ Important: holidays are assumed open unless you set a closure handler for it in the
         * exceptions setting.
         *
         * @return \Carbon\Carbon|\Carbon\CarbonImmutable|\Carbon\CarbonInterface
         */
        return $this->getCalleeAsMethod(static::PREVIOUS_CLOSE_METHOD);
    }
}
