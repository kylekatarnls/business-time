<?php

namespace BusinessTime;

use Spatie\OpeningHours\OpeningHours;

class DefinitionParser
{
    /**
     * @var MixinBase|string
     */
    protected $mixin;

    /**
     * @var OpeningHours|array
     */
    protected $openingHours;

    public function __construct($mixin, $openingHours)
    {
        $this->mixin = $mixin;
        $this->openingHours = $openingHours;
    }

    public function parseHolidaysArray($holidays = null)
    {
        $region = null;

        if (is_array($holidays) && isset($holidays[$this->mixin::REGION_OPTION_KEY])) {
            $region = $holidays[$this->mixin::REGION_OPTION_KEY];
            unset($holidays[$this->mixin::REGION_OPTION_KEY]);

            if (isset($holidays[$this->mixin::ADDITIONAL_HOLIDAYS_OPTION_KEY])) {
                $holidays = $holidays[$this->mixin::ADDITIONAL_HOLIDAYS_OPTION_KEY];
            }
        }

        return [$region, $holidays];
    }

    public function extractHolidaysFromOptions($openingHours = null)
    {
        $region = null;
        $holidays = null;

        if (is_string($openingHours[$this->mixin::HOLIDAYS_OPTION_KEY])) {
            $region = $openingHours[$this->mixin::HOLIDAYS_OPTION_KEY];
        } elseif (is_iterable($openingHours[$this->mixin::HOLIDAYS_OPTION_KEY])) {
            [$region, $holidays] = self::parseHolidaysArray($openingHours[$this->mixin::HOLIDAYS_OPTION_KEY]);
        }

        if (is_array($openingHours)) {
            unset($openingHours[$this->mixin::HOLIDAYS_OPTION_KEY]);
        }

        return [$region, $holidays, $openingHours];
    }

    public function getSetterParameters()
    {
        $region = null;
        $holidays = null;
        $openingHours = $this->openingHours;

        if (is_array($openingHours) && isset($openingHours[$this->mixin::HOLIDAYS_OPTION_KEY])) {
            [$region, $holidays, $openingHours] = self::extractHolidaysFromOptions($openingHours);
        }

        return [$this->getRegionOrFallback($region, $holidays), $holidays, $openingHours];
    }

    public function getRegionOrFallback($region, $holidays)
    {
        if ($holidays && !$region) {
            $region = 'custom-holidays';
        }

        return $region;
    }
}
