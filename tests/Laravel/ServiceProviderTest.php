<?php

namespace Tests\Carbon\Laravel;

use BusinessTime\Laravel\ServiceProvider;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ServiceProviderTest extends TestCase
{
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

        $service->boot();

        $this->assertFalse(Carbon::parse('2019-04-08')->isHoliday());
        $this->assertSame('08:00', Carbon::parse('2019-04-08')->nextOpen()->format('H:i'));

        $this->assertNull($service->register());
    }
}
