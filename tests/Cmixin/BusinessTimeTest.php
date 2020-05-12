<?php

namespace Tests\Cmixin;

use BusinessTime\DefinitionParser;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Cmixin\BusinessTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Spatie\OpeningHours\OpeningHours;
use Spatie\OpeningHours\TimeRange;

class BusinessTimeTest extends TestCase
{
    const CARBON_CLASS = Carbon::class;

    protected function setUp(): void
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
        $this->assertSame($date, $date->previousOpen());
        $this->assertSame($date, $date->previousClose());
        $this->assertSame($date, $date->previousOpenExcludingHolidays());
        $this->assertSame($date, $date->previousCloseIncludingHolidays());
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

        $carbon::setOpeningHours([
            'monday'   => ['08:00-10:40'],
            'holidays' => [
                'region' => 'fr-national',
                'with'   => [
                    'foo' => '07/09',
                ],
            ],
        ]);
        $this->assertTrue($carbon::isOpenOn('monday'));
        $this->assertSame('national-day', $carbon::parse('2010-07-14')->getHolidayId());
        $this->assertSame('foo', $carbon::parse('2010-09-07')->getHolidayId());
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

    public function testBadOpeningHoursInput()
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Opening hours parameter should be a '.
            'Spatie\OpeningHours\OpeningHours instance or an array.');

        $carbon = static::CARBON_CLASS;
        $carbon::convertOpeningHours($carbon::now());
    }

    public function testUndefinedOpeningHours()
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Opening hours have not be set.');

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

    public function testPreviousOpen()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-02 08:00:00');
        $carbon::setHolidaysRegion('fr');
        $this->assertSame('2018-11-01 13:00', $carbon::previousOpen()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-01 13:00', $carbon::now()->previousOpen()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-05 09:00:00');
        $this->assertSame('2018-11-03 13:00', $carbon::previousOpen()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-03 13:00', $carbon::now()->previousOpen()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-11 08:00:00');
        $this->assertSame('2018-11-10 13:00', $carbon::previousOpen()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-10 13:00', $carbon::now()->previousOpen()->format('Y-m-d H:i'));
        $carbon::resetHolidays();
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

    public function testPreviousClose()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-05 08:00:00');
        $this->assertSame('2018-11-03 16:00', $carbon::previousClose()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-03 16:00', $carbon::now()->previousClose()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-05 09:00:00');
        $this->assertSame('2018-11-03 16:00', $carbon::previousClose()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-03 16:00', $carbon::now()->previousClose()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-11 08:00:00');
        $this->assertSame('2018-11-10 16:00', $carbon::previousClose()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-10 16:00', $carbon::now()->previousClose()->format('Y-m-d H:i'));
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
        $carbon::setTestNow('2018-10-30 22:00:00');
        $this->assertSame('2018-10-31 09:00', $carbon::nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-10-31 09:00', $carbon::now()->nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-02 09:00:00');
        $this->assertSame('2018-11-02 13:00', $carbon::nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-02 13:00', $carbon::now()->nextOpenExcludingHolidays()->format('Y-m-d H:i'));
        $carbon::resetHolidays();
    }

    public function testPreviousOpenExcludingHolidays()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setTestNow('2018-11-02 08:00:00');
        $this->assertSame('2018-11-01 13:00', $carbon::previousOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-11-01 13:00', $carbon::now()->previousOpenExcludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-01 09:00:00');
        $this->assertSame('2018-10-31 09:00', $carbon::previousOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-10-31 09:00', $carbon::now()->previousOpenExcludingHolidays()->format('Y-m-d H:i'));

        $carbon::setHolidaysRegion('fr-national');
        $this->assertSame('2018-10-31 09:00', $carbon::previousOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-10-31 09:00', $carbon::now()->previousOpenExcludingHolidays()->format('Y-m-d H:i'));
        $carbon::setTestNow('2018-11-02 09:00:00');
        $this->assertSame('2018-10-31 09:00', $carbon::previousOpenExcludingHolidays()->format('Y-m-d H:i'));
        $this->assertSame('2018-10-31 09:00', $carbon::now()->previousOpenExcludingHolidays()->format('Y-m-d H:i'));
        $carbon::resetHolidays();
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

    public function testGetCurrentOpenTimeRanges()
    {
        $carbon = static::CARBON_CLASS;
        $date = $carbon::parse('2019-07-22 11:45');
        $list = [];

        foreach ($date->getCurrentOpenTimeRanges() as $range) {
            self::assertInstanceOf(TimeRange::class, $range);
            $list[] = (string) $range;
        }

        self::assertSame(['09:00-12:00'], $list);

        $date = $carbon::parse('2019-07-22 12:45');
        $list = [];

        foreach ($date->getCurrentOpenTimeRanges() as $range) {
            self::assertInstanceOf(TimeRange::class, $range);
            $list[] = (string) $range;
        }

        self::assertSame([], $list);
    }

    public function testGetCurrentOpenTimeRange()
    {
        $carbon = static::CARBON_CLASS;
        $date = $carbon::parse('2019-07-22 11:45');
        $range = $date->getCurrentOpenTimeRange();

        self::assertInstanceOf(TimeRange::class, $range);
        self::assertSame('09:00-12:00', (string) $range);

        $date = $carbon::parse('2019-07-22 12:45');

        self::assertFalse($date->getCurrentOpenTimeRange());
    }

    public function testCurrentOrMethods()
    {
        $carbon = static::CARBON_CLASS;
        $carbon::setHolidaysRegion('fr-national');
        BusinessTime::enable($carbon, [
            'monday'     => ['09:00-12:00', '13:00-18:00'],
            'tuesday'    => ['09:00-12:00', '13:00-18:00'],
            'wednesday'  => ['09:00-12:00', '13:00-18:00'],
            'thursday'   => ['09:00-12:00', '13:00-18:00'],
            'friday'     => ['09:00-12:00', '13:00-18:00'],
            'exceptions' => [
                '05-07' => ['11:00-12:00'],
            ],
            'holidays' => [
                'region' => 'fr-national',
                'with'   => [
                    'foo' => '11/05',
                ],
            ],
        ]);

        /**
         * @return Carbon $date
         */
        $getDate = function ($string) use ($carbon) {
            return $carbon::parse($string);
        };

        // Open (holidays)

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->currentOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-07 10:00')->currentOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 09:00', $getDate('2020-05-07 12:00')->currentOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 09:00', $getDate('2020-05-08 10:00')->currentOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->currentOrNextBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-07 10:00')->currentOrNextBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 09:00', $getDate('2020-05-07 12:00')->currentOrNextBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 09:00', $getDate('2020-05-08 10:00')->currentOrNextBusinessOpen()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->currentOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 13:00', $getDate('2020-05-07 10:00')->currentOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-07 12:00')->currentOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-08 10:00')->currentOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->currentOrPreviousBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 13:00', $getDate('2020-05-07 10:00')->currentOrPreviousBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-07 12:00')->currentOrPreviousBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-08 10:00')->currentOrPreviousBusinessOpen()->format('Y-m-d H:i'));

        // Close (holidays)

        self::assertSame('2020-05-06 12:00', $getDate('2020-05-06 10:00')->currentOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->currentOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->currentOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->currentOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 12:00', $getDate('2020-05-06 10:00')->currentOrNextBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->currentOrNextBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->currentOrNextBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->currentOrNextBusinessClose()->format('Y-m-d H:i'));

        self::assertSame('2020-05-05 18:00', $getDate('2020-05-06 10:00')->currentOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->currentOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->currentOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->currentOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-05 18:00', $getDate('2020-05-06 10:00')->currentOrPreviousBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->currentOrPreviousBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->currentOrPreviousBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->currentOrPreviousBusinessClose()->format('Y-m-d H:i'));

        // Open (no holidays)

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->currentOrNextOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-07 10:00')->currentOrNextOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 09:00', $getDate('2020-05-07 12:00')->currentOrNextOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->currentOrNextOpen()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->currentOrPreviousOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 13:00', $getDate('2020-05-07 10:00')->currentOrPreviousOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 11:00', $getDate('2020-05-07 12:00')->currentOrPreviousOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->currentOrPreviousOpen()->format('Y-m-d H:i'));

        // Close (no holidays)

        self::assertSame('2020-05-06 07:00', $getDate('2020-05-06 07:00')->currentOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 12:00', $getDate('2020-05-06 10:00')->currentOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->currentOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->currentOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 12:00', $getDate('2020-05-08 10:00')->currentOrNextClose()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 07:00', $getDate('2020-05-06 07:00')->currentOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-05 18:00', $getDate('2020-05-06 10:00')->currentOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->currentOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->currentOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-08 10:00')->currentOrPreviousClose()->format('Y-m-d H:i'));
    }

    public function testClosedOrAndOpenOrMethods()
    {
        $carbon = static::CARBON_CLASS;
        BusinessTime::enable($carbon, [
            'monday'     => ['09:00-12:00', '13:00-18:00'],
            'tuesday'    => ['09:00-12:00', '13:00-18:00'],
            'wednesday'  => ['09:00-12:00', '13:00-18:00'],
            'thursday'   => ['09:00-12:00', '13:00-18:00'],
            'friday'     => ['09:00-12:00', '13:00-18:00'],
            'exceptions' => [
                '05-07' => ['11:00-12:00'],
            ],
            'holidays' => [
                'region' => 'fr-national',
                'with'   => [
                    'foo' => '11/05',
                ],
            ],
        ]);

        /**
         * @return Carbon $date
         */
        $getDate = function (string $string) use ($carbon) {
            return $carbon::parse($string);
        };

        // Open (holidays)

        self::assertSame('2020-05-06 13:00', $getDate('2020-05-06 10:00')->closedOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->closedOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->closedOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->closedOrNextOpenExcludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 13:00', $getDate('2020-05-06 10:00')->closedOrNextBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->closedOrNextBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->closedOrNextBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->closedOrNextBusinessOpen()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 09:00', $getDate('2020-05-06 10:00')->closedOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->closedOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->closedOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->closedOrPreviousOpenExcludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 09:00', $getDate('2020-05-06 10:00')->closedOrPreviousBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->closedOrPreviousBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->closedOrPreviousBusinessOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->closedOrPreviousBusinessOpen()->format('Y-m-d H:i'));

        // Close (holidays)

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->openOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 10:00')->openOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 12:00', $getDate('2020-05-07 12:00')->openOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 12:00', $getDate('2020-05-08 10:00')->openOrNextCloseIncludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->openOrNextBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 10:00')->openOrNextBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 12:00', $getDate('2020-05-07 12:00')->openOrNextBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-12 12:00', $getDate('2020-05-08 10:00')->openOrNextBusinessClose()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->openOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 18:00', $getDate('2020-05-07 10:00')->openOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 18:00', $getDate('2020-05-07 12:00')->openOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-08 10:00')->openOrPreviousCloseIncludingHolidays()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->openOrPreviousBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 18:00', $getDate('2020-05-07 10:00')->openOrPreviousBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 18:00', $getDate('2020-05-07 12:00')->openOrPreviousBusinessClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-08 10:00')->openOrPreviousBusinessClose()->format('Y-m-d H:i'));

        // Open (no holidays)

        self::assertSame('2020-05-06 13:00', $getDate('2020-05-06 10:00')->closedOrNextOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->closedOrNextOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->closedOrNextOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 13:00', $getDate('2020-05-08 10:00')->closedOrNextOpen()->format('Y-m-d H:i'));

        self::assertSame('2020-05-06 09:00', $getDate('2020-05-06 10:00')->closedOrPreviousOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 10:00', $getDate('2020-05-07 10:00')->closedOrPreviousOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 12:00')->closedOrPreviousOpen()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 09:00', $getDate('2020-05-08 10:00')->closedOrPreviousOpen()->format('Y-m-d H:i'));

        // Close (no holidays)

        self::assertSame('2020-05-06 12:00', $getDate('2020-05-06 07:00')->openOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->openOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-07 12:00', $getDate('2020-05-07 10:00')->openOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 12:00', $getDate('2020-05-07 12:00')->openOrNextClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->openOrNextClose()->format('Y-m-d H:i'));

        self::assertSame('2020-05-05 18:00', $getDate('2020-05-06 07:00')->openOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 10:00', $getDate('2020-05-06 10:00')->openOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 18:00', $getDate('2020-05-07 10:00')->openOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-06 18:00', $getDate('2020-05-07 12:00')->openOrPreviousClose()->format('Y-m-d H:i'));
        self::assertSame('2020-05-08 10:00', $getDate('2020-05-08 10:00')->openOrPreviousClose()->format('Y-m-d H:i'));
    }

    public function testHolidaysAreClosedOption()
    {
        $carbon = static::CARBON_CLASS;

        $setOption = function (bool $option) use ($carbon) {
            BusinessTime::enable($carbon, [
                'monday'            => ['09:00-12:00', '13:00-18:00'],
                'tuesday'           => ['09:00-12:00', '13:00-18:00'],
                'wednesday'         => ['09:00-12:00', '13:00-18:00'],
                'thursday'          => ['09:00-12:00', '13:00-18:00'],
                'friday'            => ['09:00-12:00', '13:00-18:00'],
                'exceptions'        => [
                    '05-07' => ['11:00-12:00'],
                ],
                'holidaysAreClosed' => $option,
                'holidays'          => [
                    'region' => 'fr-national',
                    'with'   => [
                        'foo' => '11/05',
                    ],
                ],
            ]);
        };

        /**
         * @return Carbon $date
         */
        $getDate = function (string $string) use ($carbon) {
            return $carbon::parse($string);
        };

        $setOption(false);

        $this->assertTrue($getDate('2020-05-08 11:15')->isOpen());
        $this->assertTrue($getDate('2020-05-11 11:15')->isOpen());

        $setOption(true);

        $this->assertFalse($getDate('2020-05-08 11:15')->isOpen());
        $this->assertFalse($getDate('2020-05-11 11:15')->isOpen());
    }

    public function testDeprecatedGetSetterParameters()
    {
        $deprecation = 'The DefinitionParser::getSetterParameters method is deprecated,'.
            ' use DefinitionParser::getDefinition() instead which also support split argument list.';

        $this->assertSame([null, null, []], (new DefinitionParser(new BusinessTime(), []))->getSetterParameters());

        $lastError = error_get_last();

        $this->assertSame(E_USER_DEPRECATED, $lastError['type']);
        $this->assertSame($deprecation, $lastError['message']);
    }

    public function testHolidaysAreClosedOptionOnTheFly()
    {
        $carbon = static::CARBON_CLASS;
        BusinessTime::enable($carbon, [
            'monday'            => ['13:00-18:00'],
            'holidaysAreClosed' => true,
            'holidays'          => [
                'region' => 'fr-national',
            ],
        ]);

        $setOption = function (bool $option) use ($carbon) {
            $carbon::setOpeningHours([
                'monday'            => ['09:00-12:00', '13:00-18:00'],
                'tuesday'           => ['09:00-12:00', '13:00-18:00'],
                'wednesday'         => ['09:00-12:00', '13:00-18:00'],
                'thursday'          => ['09:00-12:00', '13:00-18:00'],
                'friday'            => ['09:00-12:00', '13:00-18:00'],
                'exceptions'        => [
                    '05-07' => ['11:00-12:00'],
                ],
                'holidaysAreClosed' => $option,
                'holidays'          => [
                    'region' => 'fr-national',
                    'with'   => [
                        'foo' => '11/05',
                    ],
                ],
            ]);
        };

        /**
         * @return Carbon $date
         */
        $getDate = function (string $string) use ($carbon) {
            return $carbon::parse($string);
        };

        $setOption(false);

        $this->assertTrue($getDate('2020-05-08 11:15')->isOpen());
        $this->assertTrue($getDate('2020-05-11 11:15')->isOpen());

        $setOption(true);

        $this->assertFalse($getDate('2020-05-08 11:15')->isOpen());
        $this->assertFalse($getDate('2020-05-11 11:15')->isOpen());
    }

    public function testEnableWithNoOpeningHours()
    {
        $carbon = static::CARBON_CLASS;
        $date = $carbon::parse('2019-07-04 10:00');

        self::assertFalse($date->isHoliday());

        BusinessTime::enable($carbon, 'us-national');

        self::assertTrue($date->isHoliday());
    }

    public function testEnableWithNoRegion()
    {
        $carbon = static::CARBON_CLASS;
        BusinessTime::enable($carbon, [
            'monday'   => ['09:00-12:00', '13:00-18:00'],
            'holidays' => [
                'company-special-holiday' => '07/04',
            ],
        ]);

        $date = $carbon::parse('2021-04-07 10:00');
        self::assertTrue($date->isBusinessClosed());
    }

    public function testAddBusinessInterval()
    {
        $carbon = static::CARBON_CLASS;
        BusinessTime::enable($carbon, [
            'monday'    => ['09:00-12:00', '13:00-18:00'],
            'tuesday'   => ['09:00-12:00', '13:00-18:00'],
            'wednesday' => ['09:00-12:00', '13:00-18:00'],
            'thursday'  => ['09:00-12:00', '13:00-18:00'],
            'friday'    => ['09:00-12:00', '13:00-18:00'],
            'holidays'  => [
                'company-special-holiday' => '07/04',
            ],
        ]);

        /**
         * @return Carbon $date
         */
        $getDate = function (string $string) use ($carbon) {
            return $carbon::parse($string);
        };

        $calculate = function (string $string, ...$params) use ($getDate) {
            $date = $getDate($string)->addBusinessInterval(...$params);

            return $date->microsecond ? $date->format('Y-m-d H:i:s.u') : "$date";
        };

        $this->assertSame('2021-04-05 09:00:00', $calculate('2021-04-05 7:00', true));
        $this->assertSame('2021-04-05 10:00:00', $calculate('2021-04-05 10:00', true));
        $this->assertSame('2021-04-05 10:00:00', $calculate('2021-04-05 09:00', true, 1, 'hour'));
        $this->assertSame('2021-04-05 14:00:00', $calculate('2021-04-05 12:00', true, 1, 'hour'));
        $this->assertSame('2021-04-05 14:00:00', $calculate('2021-04-05 13:00', true, 1, 'hour'));
        $this->assertSame('2021-04-06 10:00:00', $calculate('2021-04-05 18:00', true, 1, 'hour'));
        $this->assertSame('2021-04-05 16:00:00', $calculate('2021-04-05 09:00', true, 6, 'hour'));
        $this->assertSame('2021-04-06 10:00:00', $calculate('2021-04-05 12:00', true, 6, 'hour'));
        $this->assertSame('2021-04-06 10:00:00', $calculate('2021-04-05 13:00', true, 6, 'hour'));
        $this->assertSame('2021-04-06 16:00:00', $calculate('2021-04-05 18:00', true, 6, 'hour'));
        $this->assertSame('2021-04-06 09:00:00', $calculate('2021-04-05 09:00', true, 8, 'hour'));
        $this->assertSame('2021-04-06 13:00:00', $calculate('2021-04-05 12:00', true, 8, 'hour'));
        $this->assertSame('2021-04-06 13:00:00', $calculate('2021-04-05 13:00', true, 8, 'hour'));
        $this->assertSame('2021-04-07 09:00:00', $calculate('2021-04-05 18:00', true, 8, 'hour'));
        $this->assertSame('2021-04-05 15:00:00', $calculate('2021-04-05 10:00', true, 4, 'hours'));
        $this->assertSame('2021-04-05 14:00:00', $calculate('2021-04-05 7:00', true, 4, 'hours'));
        $this->assertSame('2021-04-05 11:59:59', $calculate('2021-04-05 7:00', true, '2 hours 59 minutes 59 seconds'));
        $this->assertSame('2021-04-05 13:00:00', $calculate('2021-04-05 7:00', true, '180 minutes'));
        $this->assertSame('2021-04-05 11:59:59.999999', $calculate('2021-04-05 7:00', true, CarbonInterval::microseconds(3 * 60 * 60 * 1000000 - 1)));
        $this->assertSame('2021-04-05 13:00:00', $calculate('2021-04-05 7:00', true, CarbonInterval::microseconds(3 * 60 * 60 * 1000000)));
        $this->assertSame('2021-04-05 13:00:00.000001', $calculate('2021-04-05 7:00', true, CarbonInterval::microseconds(3 * 60 * 60 * 1000000 + 1)));

        $this->assertSame('2021-04-05 07:00:00', $calculate('2021-04-05 7:00', false));
        $this->assertSame('2021-04-05 12:00:00', $calculate('2021-04-05 10:00', false));
        $this->assertSame('2021-04-05 21:00:00', $calculate('2021-04-05 10:00', false, 4, 'hours'));
        $this->assertSame('2021-04-05 19:00:00', $calculate('2021-04-05 7:00', false, 4, 'hours'));

        // 1 work week (but with 1 holiday in the middle)
        $this->assertSame('2021-04-13 14:00:00', $calculate('2021-04-05 14:00', true, 5 * 8, 'hours', BusinessTime::HOLIDAYS_ARE_CLOSED));

        // 1 work week (without the option to ignore holidays)
        $this->assertSame('2021-04-12 14:00:00', $calculate('2021-04-05 14:00', true, 5 * 8, 'hours'));

        $this->assertSame('2021-04-05 10:00:00', $calculate('2021-04-05 15:00', true, -4, 'hours'));
        $this->assertSame('2021-04-02 17:00:00', $calculate('2021-04-05 14:00', true, -5, 'hours'));
        $this->assertSame('2021-04-05 09:00:00', $calculate('2021-04-05 14:00', true, -4, 'hours'));
        $this->assertSame('2021-04-02 17:00:00', $calculate('2021-04-05 10:59:59', true, '-2 hours -59 minutes -59 seconds'));
        $this->assertSame('2021-04-05 09:00:00', $calculate('2021-04-05 11:59:59', true, '-2 hours -59 minutes -59 seconds'));
        $this->assertSame('2021-04-02 17:00:01', $calculate('2021-04-05 11:00:00', true, '-2 hours -59 minutes -59 seconds'));
        $this->assertSame('2021-04-05 09:00:01', $calculate('2021-04-05 12:00:00', true, '-2 hours -59 minutes -59 seconds'));
        $this->assertSame('2021-04-02 15:00:00', $calculate('2021-04-05 7:00', true, '-180 minutes'));
        $this->assertSame('2021-04-05 10:00:00', $calculate('2021-04-05 13:00:00', true, '-180 minutes'));
        $this->assertSame('2021-04-05 10:00:00.000001', $calculate('2021-04-05 14:00:00', true, CarbonInterval::microseconds(1 - 3 * 60 * 60 * 1000000)));
        $this->assertSame('2021-04-05 10:00:00', $calculate('2021-04-05 14:00:00', true, CarbonInterval::microseconds(-3 * 60 * 60 * 1000000)));
        $this->assertSame('2021-04-05 09:59:59.999999', $calculate('2021-04-05 14:00:00', true, CarbonInterval::microseconds(-1 - 3 * 60 * 60 * 1000000)));

        $this->assertSame('2021-04-05 12:00:00', $calculate('2021-04-05 21:00', false, -4, 'hours'));
        $this->assertSame('2021-04-05 06:00:00', $calculate('2021-04-05 15:00', false, -4, 'hours'));
        $this->assertSame('2021-04-05 07:00:00', $calculate('2021-04-05 19:00', false, -4, 'hours'));

        // 1 work week (but with 1 holiday in the middle)
        $this->assertSame('2021-04-05 14:00:00', $calculate('2021-04-13 14:00', true, -5 * 8, 'hours', BusinessTime::HOLIDAYS_ARE_CLOSED));

        // 1 work week (without the option to ignore holidays)
        $this->assertSame('2021-04-05 14:00:00', $calculate('2021-04-12 14:00', true, -5 * 8, 'hours'));

        // Ignore holidays via settings
        $carbon = static::CARBON_CLASS;
        BusinessTime::enable($carbon, [
            'monday'            => ['09:00-12:00', '13:00-18:00'],
            'tuesday'           => ['09:00-12:00', '13:00-18:00'],
            'wednesday'         => ['09:00-12:00', '13:00-18:00'],
            'thursday'          => ['09:00-12:00', '13:00-18:00'],
            'friday'            => ['09:00-12:00', '13:00-18:00'],
            'holidaysAreClosed' => true,
            'holidays'          => [
                'company-special-holiday' => '07/04',
            ],
        ]);

        // Setting make 7/4 closed no matter the option is used or not
        $this->assertSame('2021-04-13 14:00:00', $calculate('2021-04-05 14:00', true, 5 * 8, 'hours', BusinessTime::HOLIDAYS_ARE_CLOSED));
        $this->assertSame('2021-04-13 14:00:00', $calculate('2021-04-05 14:00', true, 5 * 8, 'hours'));
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
