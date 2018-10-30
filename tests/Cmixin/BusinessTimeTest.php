<?php
namespace Tests\Cmixin;

use Cmixin\BusinessTime;
use PHPUnit\Framework\TestCase;

class BusinessTimeTest extends TestCase
{
    const CARBON_CLASS = 'Carbon\Carbon';

    protected function setUp()
    {
        BusinessTime::enable(static::CARBON_CLASS);
        $carbon = static::CARBON_CLASS;
        $carbon::resetHolidays();
    }
}
