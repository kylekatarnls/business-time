<?php

namespace Tests\Cmixin;

use Carbon\Carbon;
use Cmixin\BusinessTime;
use PHPUnit\Framework\TestCase;
use Spatie\OpeningHours\OpeningHours;

class BusinessTimeTest extends TestCase
{
    const CARBON_CLASS = Carbon::class;

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

    public function testMutability()
    {
        $carbon = static::CARBON_CLASS;
        $date = $carbon::now();
        $this->assertSame($date, $date->nextOpen());
        $this->assertSame($date, $date->nextClose());
        $this->assertSame($date, $date->nextOpenExcludingHolidays());
        $this->assertSame($date, $date->nextCloseIncludingHolidays());
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

    public function testSetOpeningHours()
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
        $date->resetOpeningHours();
        $this->assertTrue($date->isOpenOn('sunday'));
        $this->assertTrue($date->isClosedOn('tuesday'));

        $carbon::setOpeningHours([
            -1 => ['08:00-10:40'],
        ]);
        $this->assertTrue($carbon::isOpenOn('saturday'));
        $this->assertTrue($carbon::isClosedOn('sunday'));
    }

    public function testGetOpeningHours()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertInstanceOf(OpeningHours::class, $carbon::getOpeningHours());
        $now = $carbon::now();
        $this->assertInstanceOf(OpeningHours::class, $now->getOpeningHours());
        $now->setOpeningHours([
            $carbon::TUESDAY => ['12:30-15:00'],
        ]);
        $this->assertInstanceOf(OpeningHours::class, $now->getOpeningHours());
    }

    public function testNeutralEnable()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertTrue($carbon::enable());
    }

    public function testConvertOpeningHours()
    {
        $carbon = static::CARBON_CLASS;
        $this->assertInstanceOf(OpeningHours::class, $carbon::convertOpeningHours([]));
        $this->assertInstanceOf(OpeningHours::class, $carbon::convertOpeningHours(OpeningHours::create([])));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Opening hours parameter should be a Spatie\OpeningHours\OpeningHours instance or an array.
     */
    public function testBadOpeningHoursInput()
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
        $carbon::resetOpeningHours();
        BusinessTime::enable($carbon);
        $carbon::getOpeningHours();
    }

    public function testIsOpen()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-05 08:00:00');
        $this->assertFalse($carbon::isOpen());
        $this->assertFalse($carbon::now()->isOpen());
        $carbon::setTestNow('2018-11-05 09:00:00');
        $this->assertTrue($carbon::isOpen());
        $this->assertTrue($carbon::now()->isOpen());
        $carbon::setTestNow('2018-11-11 08:00:00');
        $this->assertFalse($carbon::isOpen());
        $this->assertFalse($carbon::now()->isOpen());
    }

    public function testIsClosed()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-05 08:00:00');
        $this->assertTrue($carbon::isClosed());
        $this->assertTrue($carbon::now()->isClosed());
        $carbon::setTestNow('2018-11-05 09:00:00');
        $this->assertFalse($carbon::isClosed());
        $this->assertFalse($carbon::now()->isClosed());
        $carbon::setTestNow('2018-11-11 08:00:00');
        $this->assertTrue($carbon::isClosed());
        $this->assertTrue($carbon::now()->isClosed());
    }

    public function testIsOpenExcludingHolidays()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-01 08:00:00');
        $this->assertFalse($carbon::isOpenExcludingHolidays());
        $this->assertFalse($carbon::now()->isOpenExcludingHolidays());
        $carbon::setTestNow('2018-11-01 09:00:00');
        $this->assertTrue($carbon::isOpenExcludingHolidays());
        $this->assertTrue($carbon::now()->isOpenExcludingHolidays());

        $carbon::setHolidaysRegion('fr-national');
        $this->assertFalse($carbon::isOpenExcludingHolidays());
        $this->assertFalse($carbon::now()->isOpenExcludingHolidays());
        $carbon::setTestNow('2018-11-02 09:00:00');
        $this->assertTrue($carbon::isOpenExcludingHolidays());
        $this->assertTrue($carbon::now()->isOpenExcludingHolidays());
    }

    public function testIsClosedIncludingHolidays()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-01 08:00:00');
        $this->assertTrue($carbon::isClosedIncludingHolidays());
        $this->assertTrue($carbon::now()->isClosedIncludingHolidays());
        $carbon::setTestNow('2018-11-02 08:00:00');
        $this->assertTrue($carbon::isClosedIncludingHolidays());
        $this->assertTrue($carbon::now()->isClosedIncludingHolidays());
        $carbon::setTestNow('2018-11-01 09:00:00');
        $this->assertFalse($carbon::isClosedIncludingHolidays());
        $this->assertFalse($carbon::now()->isClosedIncludingHolidays());

        $carbon::setHolidaysRegion('fr-national');
        $this->assertTrue($carbon::isClosedIncludingHolidays());
        $this->assertTrue($carbon::now()->isClosedIncludingHolidays());
        $carbon::setTestNow('2018-11-02 09:00:00');
        $this->assertFalse($carbon::isClosedIncludingHolidays());
        $this->assertFalse($carbon::now()->isClosedIncludingHolidays());
    }

    public function testNextOpen()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-05 08:00:00');
        $this->assertSame('2018-11-05 09:00', $carbon::nextOpen()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-05 09:00', $carbon::now()->nextOpen()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-05 09:00:00');
        $this->assertSame('2018-11-05 13:00', $carbon::nextOpen()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-05 13:00', $carbon::now()->nextOpen()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-11 08:00:00');
        $this->assertSame('2018-11-12 09:00', $carbon::nextOpen()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-12 09:00', $carbon::now()->nextOpen()->format('Y-m-d H:i'));
    }

    public function testNextClose()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-05 08:00:00');
        $this->assertSame('2018-11-05 12:00', $carbon::nextClose()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-05 12:00', $carbon::now()->nextClose()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-05 09:00:00');
        $this->assertSame('2018-11-05 12:00', $carbon::nextClose()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-05 12:00', $carbon::now()->nextClose()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-11 08:00:00');
        $this->assertSame('2018-11-12 12:00', $carbon::nextClose()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-12 12:00', $carbon::now()->nextClose()->format('Y-m-d H:i'));
    }

    public function testNextOpenExcludingHolidays()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-01 08:00:00');
        $this->assertSame('2018-11-01 09:00', $carbon::nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-01 09:00', $carbon::now()->nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-01 09:00:00');
        $this->assertSame('2018-11-01 13:00', $carbon::nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-01 13:00', $carbon::now()->nextOpenExcludingHolidays()->format('Y-m-d H:i'));

        $carbon::setHolidaysRegion('fr-national');
        $this->assertSame('2018-11-02 09:00', $carbon::nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-02 09:00', $carbon::now()->nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-02 09:00:00');
        $this->assertSame('2018-11-02 13:00', $carbon::nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-02 13:00', $carbon::now()->nextOpenExcludingHolidays()->format('Y-m-d H:i'));
    }

    public function testNextCloseIncludingHolidays()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-01 08:00:00');
        $this->assertSame('2018-11-01 12:00', $carbon::nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-01 12:00', $carbon::now()->nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-02 08:00:00');
        $this->assertSame('2018-11-02 12:00', $carbon::nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-02 12:00', $carbon::now()->nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-01 09:00:00');
        $this->assertSame('2018-11-01 12:00', $carbon::nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-01 12:00', $carbon::now()->nextCloseIncludingHolidays()->format('Y-m-d H:i'));

        $carbon::setHolidaysRegion('fr-national');
        $this->assertSame('2018-11-02 12:00', $carbon::nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-02 12:00', $carbon::now()->nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-02 09:00:00');
        $this->assertSame('2018-11-02 12:00', $carbon::nextCloseIncludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-02 12:00', $carbon::now()->nextCloseIncludingHolidays()->format('Y-m-d H:i'));
    }

    public function testFilterCallback()
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
                function ($date) use ($carbon) {
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

    public function testReadmeCode()
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
                '01-01'      => [],
                '12-25'      => ['09:00-12:00'],
            ],
            'holidays'   => [
                'region' => 'us-national',
                'with'   => [
                    'labor-day'               => null,
                    'company-special-holiday' => '07/04',
                ],
            ],
        ]);

        $date = $carbon::parse('2021-04-07 10:00');
        self::assertTrue($date->isBusinessClosed());
        $date = $carbon::parse('2021-04-08 10:00');
        self::assertTrue($date->isBusinessOpen());
        $date = $carbon::parse('2021-07-04 10:00');
        self::assertTrue($date->isBusinessClosed());

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
                '01-01'      => [],
                '12-25'      => ['09:00-12:00'],
            ],
            'holidays'   => 'fr-national',
        ]);

        $date = $carbon::parse('2020-07-14 10:00');
        self::assertTrue($date->isBusinessClosed());
        $date = $carbon::parse('2020-07-15 10:00');
        self::assertTrue($date->isBusinessOpen());
    }
}
