<?php
namespace Tests\Cmixin;

use Cmixin\BusinessTime;
use PHPUnit\Framework\TestCase;

class BusinessTimeTest extends TestCase
{
    const CARBON_CLASS = 'Carbon\Carbon';

    protected function setUp()
    {
        BusinessTime::enable(static::CARBON_CLASS, [
            'monday' => ['09:00-12:00', '13:00-18:00'],
            'tuesday' => ['09:00-12:00', '13:00-18:00'],
            'wednesday' => ['09:00-12:00'],
            'thursday' => ['09:00-12:00', '13:00-18:00'],
            'friday' => ['09:00-12:00', '13:00-20:00'],
            'saturday' => ['09:00-12:00', '13:00-16:00'],
            'sunday' => [],
            'exceptions' => [
                '2016-11-11' => ['09:00-12:00'],
                '2016-12-25' => [],
                '01-01' => [], // Recurring on each 1st of january
                '12-25' => ['09:00-12:00'], // Recurring on each 25th of december
            ],
        ]);
        $carbon = static::CARBON_CLASS;
        $carbon::resetHolidays();
    }

    public function testIsOpenOn()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertTrue($carbon::isOpenOn('monday'));
        $this->assertFalse($carbon::isOpenOn('sunday'));
        $this->assertTrue($carbon::isClosedOn('sunday'));
        $this->assertFalse($carbon::isClosedOn('monday'));
    }
}
