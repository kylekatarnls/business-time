<?php

namespace Tests\Cmixin;

use Cmixin\BusinessTime;
use PHPUnit\Framework\TestCase;

class BusinessTimeTest extends TestCase
{
    const CARBON_CLASS = 'Carbon\Carbon';

    protected function setUp()
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
                '2016-11-11' => ['09:00-12:00'],
                '2016-12-25' => [],
                '01-01'      => [], // Recurring on each 1st of january
                '12-25'      => ['09:00-12:00'], // Recurring on each 25th of december
            ],
        ]);
        $carbon::resetHolidays();
    }

    public function testIsOpenOn()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertTrue($carbon::isOpenOn('monday'));
        $this->assertFalse($carbon::isOpenOn('sunday'));
    }

    public function testIsClosedOn()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertTrue($carbon::isClosedOn('sunday'));
        $this->assertFalse($carbon::isClosedOn('monday'));
    }

    public function testOpeningHours()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertNull($carbon::setOpeningHours([
            $carbon::SUNDAY => ['08:00-10:40'],
        ]));
        $now = $carbon::now();
        $date = $now->setOpeningHours([
            $carbon::TUESDAY => ['12:30-15:00'],
        ]);
        $this->assertSame($date, $now);
        $this->assertTrue($carbon::isOpenOn('sunday'));
        $this->assertTrue($carbon::isClosedOn('tuesday'));
        $this->assertTrue($date->isOpenOn('tuesday'));
        $this->assertTrue($date->isClosedOn('sunday'));

        $carbon::setOpeningHours([
            -1 => ['08:00-10:40'],
        ]);
        $this->assertTrue($carbon::isOpenOn('saturday'));
        $this->assertTrue($carbon::isClosedOn('sunday'));
    }

    public function testNeutralEnable()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertTrue($carbon::enable());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Opening hours parameter should be a Spatie\OpeningHours\OpeningHours instance or an array.
     */
    public function testConvertOpeningHours()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::convertOpeningHours($carbon::now());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Opening hours has not be set.
     */
    public function testUndefinedOpeningHours()
    {
        $carbon = static::CARBON_CLASS;
        if (!method_exists($carbon, 'resetMacros')) {
            $this->markTestSkipped('This test needs Carbon 2.1.0');
        }
        $carbon::resetMacros();
        BusinessTime::enable($carbon);
        $carbon::getOpeningHours();
    }
}
