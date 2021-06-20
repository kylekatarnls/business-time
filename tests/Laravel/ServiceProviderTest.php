<?php

namespace Tests\Carbon\Laravel;

use BusinessTime\Laravel\ServiceProvider;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;

class ServiceProviderTest extends TestCase
{
    private static $businessDayVersion;

    public static function setUpBeforeClass(): void
    {
        $composerConfig = require(__DIR__ . '/../../vendor/composer/installed.php');
        self::$businessDayVersion = $composerConfig['versions']['cmixin/business-day'] ?? 'dev-master';

        if (!preg_match('/^\d+\./', self::$businessDayVersion)) {
            self::$businessDayVersion = '1.999';
        }
    }

    public function testBoot()
    {
        include_once __DIR__.'/ServiceProvider.php';
        $service = new ServiceProvider();
        $message = null;

        Carbon::macro('isHoliday', null);

        try {
            Carbon::parse('2019-04-08')->isHoliday();
        } catch (\BadMethodCallException $e) {
            $message = $e->getMessage();
        }

        $this->assertSame('Method isHoliday does not exist.', $message);

        $this->assertNull($service->boot());

        $this->assertFalse(Carbon::parse('2019-04-08')->isHoliday());
        $this->assertSame('08:00', Carbon::parse('2019-04-08')->nextOpen()->format('H:i'));

        $this->assertNull($service->register());

        $service->app->setHours(null);

        $this->assertNull($service->boot());

        if (version_compare(self::$businessDayVersion, '1.3.0', '>=')) {
            $this->assertNull(Carbon::getHolidaysRegion());
        }
    }

    public function testConfig()
    {
        if (version_compare(self::$businessDayVersion, '1.3.0', '<')) {
            $this->markTestSkipped('This test requires cmixin/business-day >= 1.3.0');
        }

        include_once __DIR__.'/ServiceProvider.php';
        $service = new ServiceProvider();
        $classes = [
            Carbon::class,
            CarbonImmutable::class,
        ];

        foreach ($classes as $class) {
            $message = null;

            $class::macro('getHolidaysRegion', null);

            try {
                $class::getHolidaysRegion();
            } catch (\BadMethodCallException $e) {
                $message = $e->getMessage();
            }

            $this->assertSame("Method $class::getHolidaysRegion does not exist.", $message);
        }

        $service->app->setHours(['holidays' => ['region' => 'au-qld']]);
        $service->boot();
        $service->register();

        foreach ($classes as $class) {
            $this->assertSame('au-qld', $class::getHolidaysRegion());
        }
    }
}
