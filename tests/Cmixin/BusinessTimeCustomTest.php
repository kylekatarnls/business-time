<?php

namespace Tests\Cmixin;

use Carbon\Carbon;
use Cmixin\BusinessTime;

class MyCarbon extends Carbon
{
}

class BusinessTimeCustomTest extends BusinessTimeTest
{
    const CARBON_CLASS = MyCarbon::class;

    public function testFilterCallbackWithType()
    {
        $carbon = static::CARBON_CLASS;
        BusinessTime::enable($carbon, [
            'monday'     => ['09:00-12:00', '13:00-18:00'],
            'tuesday'    => ['09:00-12:00', '13:00-18:00'],
            'wednesday'  => ['09:00-12:00'],
            'thursday'   => ['09:00-12:00', '13:00-18:00'],
            'friday'     => ['09:00-12:00', '13:00-20:00'],
            'saturday'   => ['09:00-12:00', '13:00-16:00'],
            'sunday'     => [],
            'exceptions' => [
                function (MyCarbon $date) use ($carbon) {
                    $this->assertInstanceOf($carbon, $date);

                    if ($date->getHolidayId() === 'christmas') {
                        return ['10:00-12:00'];
                    }

                    if ($date->isHoliday()) {
                        return [];
                    }
                },
            ],
        ]);
        $carbon::resetHolidays();
        $carbon::setHolidaysRegion('fr-national');
        $this->assertSame('2016-12-26 09:00:00', (string) $carbon::parse('2016-12-25 12:00:00')->nextOpen());
        $date = $carbon::parse('2018-12-25');
        $this->assertSame('10:00-12:00', (string) $date->getOpeningHours()->forDate($date));
        $date = $carbon::parse('2018-01-01');
        $this->assertSame('', (string) $date->getCurrentDayOpeningHours());
        $date = $carbon::parse('2018-01-02');
        $this->assertSame('09:00-12:00,13:00-18:00', (string) $date->getCurrentDayOpeningHours());
    }
}
