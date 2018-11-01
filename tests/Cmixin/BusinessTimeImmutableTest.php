<?php

namespace Tests\Cmixin;

use Carbon\CarbonImmutable;

class BusinessTimeImmutableTest extends BusinessTimeTest
{
    const CARBON_CLASS = CarbonImmutable::class;

    public function testMutability()
    {
        $carbon = static::CARBON_CLASS;
        $date = $carbon::now();
        $this->assertNotSame($date, $date->nextOpen());
        $this->assertNotSame($date, $date->nextClose());
        $this->assertNotSame($date, $date->nextOpenExcludingHolidays());
        $this->assertNotSame($date, $date->nextCloseIncludingHolidays());
    }
}
