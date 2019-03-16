# business-time

Carbon mixin to handle business days and opening hours

[![Latest Stable Version](https://poser.pugx.org/cmixin/business-time/v/stable.png)](https://packagist.org/packages/cmixin/business-time)
[![Build Status](https://travis-ci.org/kylekatarnls/business-time.svg?branch=master)](https://travis-ci.org/kylekatarnls/business-time)
[![Code Climate](https://codeclimate.com/github/kylekatarnls/business-time/badges/gpa.svg)](https://codeclimate.com/github/kylekatarnls/business-time)
[![Test Coverage](https://codeclimate.com/github/kylekatarnls/business-time/badges/coverage.svg)](https://codeclimate.com/github/kylekatarnls/business-time/coverage)
[![Issue Count](https://codeclimate.com/github/kylekatarnls/business-time/badges/issue_count.svg)](https://codeclimate.com/github/kylekatarnls/business-time)
[![StyleCI](https://styleci.io/repos/155368756/shield?branch=master)](https://styleci.io/repos/155368756)

[Professionally supported nesbot/carbon is now available](https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=readme)

## Install

```shell
composer require cmixin/business-time
```

## Usage

First load the mixin in some global bootstrap place of your app:

```php
<?php

use Carbon\Carbon;
use Cmixin\BusinessTime;

BusinessTime::enable(Carbon::class);
// Or if you use Laravel:
// BusinessDay::enable('Illuminate\Support\Carbon');

// As a second argument you can set default opening hours:
BusinessTime::enable(Carbon::class, [
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
  'holidays' => [
    'region' => 'us-ny', // Load the official list of holidays from USA - New York
    'with' => [
      'labor-day' => null, // Remove the Labor Day (so the business is open)
      'company-special-holiday' => '04-07', // Add some custom holiday of your company 
    ],
  ],
]);
```

Business days methods are now available on any Carbon instance
used anywhere later.

## Features

By enabling `BusinessTime` you automatically benefit on every holidays features of `BusinessDay`,
see [cmixin/business-day](https://github.com/kylekatarnls/business-day)

As soon as you set opening hours (using the second parameter of `BusinessTime::enable()`,
`Carbon::setOpeningHours([...])` or `$carbonDate->setOpeningHours([...])`), you'll be able to retrieve opening hours
on any Carbon instance or statically (`$carbonDate->getOpeningHours()` or `Carbon::getOpeningHours()`) as an
instance of `OpeningHours` (`spatie/opening-hours`),
see [spatie/opening-hours](https://github.com/spatie/opening-hours) for complete list of features of this class.

Then with opening hours, you'll get the following methods directly available on Carbon instances:

### Holidays

By default, holidays has no particular opening hours, it will use the opening hours of the current day of week, but
you can use a custom exception to link automatically holidays to custom opening hours:

```php
BusinessTime::enable(Carbon::class, [
  'monday' => ['09:00-12:00', '13:00-18:00'],
  'tuesday' => ['09:00-12:00', '13:00-18:00'],
  'wednesday' => ['09:00-12:00'],
  'thursday' => ['09:00-12:00', '13:00-18:00'],
  'friday' => ['09:00-12:00', '13:00-20:00'],
  'saturday' => ['09:00-12:00', '13:00-16:00'],
  'sunday' => [],
  'exceptions' => [
    function (Carbon $date) {
      if ($date->isHoliday()) {
        // Or use ->isObservedHoliday() and set observed holidays:
        // https://github.com/kylekatarnls/business-day#setobservedholidayszone
        switch ($date->getHolidayId()) {
          // If the ID "christmas" exists in the selected holidays region and matches the current date:
          case 'christmas':
            return ['10:00-12:00'];
          default:
            return []; // All other holidays are closed all day long
            // Here you can also pass context data:
            return [
              'hours' => [],
              'data'  => [
                'reason' => 'Today is ' . $date->getHolidayName(),
              ],
            ];
        }
      }
      // Else, typical day => use days of week settings
    },
  ],
]);

Carbon::setHolidaysRegion('us-national');
Carbon::parse('2018-12-25 11:00')->isOpen(); // true  matches custom opening hours of Christmas
Carbon::parse('2018-12-25 13:00')->isOpen(); // false
Carbon::parse('2019-01-01 11:00')->isOpen(); // false closed all day long
Carbon::parse('2019-01-02 11:00')->isOpen(); // true  not an holiday in us-national region, so it's open as any common wednesday
```

### isOpenOn

Allows to know if the business is usually on open on a given day.

```php
Carbon::isOpenOn('monday') // Returns true if default opening hours include monday
                           // Carbon::MONDAY would also works

$date->isOpenOn('monday') // Returns true $date opening hours include monday, if $date has no opening hours set,
                          // if will fallback to default opening hours you set globally
``` 

### isClosedOn

Opposite of isOpenOn

```php
Carbon::isClosedOn('monday')
$date->isClosedOn('monday')
``` 

### isOpen

Allows to know if the business is usually on open at a given moment.

```php
Carbon::isOpen()       // returns true if the business is now open
$carbonDate->isOpen()  // returns true if the business is open at the current date and time

if (Carbon::isOpen()) {
  $closingTime = Carbon::nextClose()->isoFormat('LT');
  echo "It's now open and until $closingTime.";
}
``` 

### isClosed

Opposite of isOpen

```php
Carbon::isClosed()       // returns true if the business is now closed
$carbonDate->isClosed()  // returns true if the business is closed at the current date and time

if (Carbon::isClosed()) {
  $openingTime = Carbon::nextClose()->calendar();
  echo "It's now closed and will re-open $openingTime.";
}
``` 

### nextOpen

Go to next open-business time.

```php
Carbon::nextOpen()       // go to next open time from now
$carbonDate->nextOpen()  // go to next open time from $carbonDate
``` 

### nextClose

Go to next closed-business time.

```php
Carbon::nextClose()       // go to next close time from now
$carbonDate->nextClose()  // go to next close time from $carbonDate
``` 

### getCurrentDayOpeningHours

Returns the opening hours current day settings (first matching exception or else current weekday settings).

```php
BusinessTime::enable(Carbon::class, [
  'monday' => [
    'data' => [
      'remarks' => 'Extra evening on Monday',
    ],
    'hours' => [
        '09:00-12:00',
        '13:00-18:00',
        '19:00-20:00',
    ]
  ],
  // ...
]);

$todayRanges = Carbon::getCurrentDayOpeningHours(); // Equivalent to Carbon::now()->getCurrentDayOpeningHours()
// You can also get opening hours of any other day: Carbon::parse('2018-01-16')->getCurrentDayOpeningHours()

echo '<h1>Today office open hours</h1>';
$data = $todayRanges->getData();
if (is_array($data) && isset($data['remarks'])) {
  echo '<p><em>' . $data['remarks'] . '</em></p>';
}
// $todayRanges is iterable on every time range of the day.
foreach ($todayRanges as $range) {
  // TimeRange object have start, end and data properties but can also be implicitly converted as strings:
  echo '<p><time>' . $range . '</time></p>';
}
// $todayRanges can also be directly dumped as string
echo '<p>' . $todayRanges . '</p>';
```

### isBusinessOpen / isOpenExcludingHolidays

Allows to know if the business is usually on open at a given moment and not an holidays. But you also can handle holidays
with a dedicated exception for a finest setting. [See Holidays section](#Holidays)

```php
Carbon::setHolidaysRegion('us-national');
Carbon::isBusinessOpen()       // returns true if the business is now open and not an holiday
$carbonDate->isBusinessOpen()  // returns true if the business is open and not an holiday at the current date and time
``` 

### isBusinessClosed / isClosedIncludingHolidays

Opposite of [isOpenExcludingHolidays](#isOpenExcludingHolidays)

```php
Carbon::setHolidaysRegion('us-national');
Carbon::isBusinessClosed()       // returns true if the business is now closed or an holiday
$carbonDate->isBusinessClosed()  // returns true if the business is closed or an holiday at the current date and time
``` 

### nextOpenExcludingHolidays

Go to next open time (considering all holidays as closed time). But prefer to handle holidays with a dedicated
exception for a finest setting. [See Holidays section](#Holidays)

```php
Carbon::setHolidaysRegion('us-national');
echo Carbon::isOpenExcludingHolidays();
echo $carbonDate->isOpenExcludingHolidays();
``` 

### nextCloseIncludingHolidays

Go to next closed time (considering all holidays as closed time). But prefer to handle holidays with a dedicated
exception for a finest setting. [See Holidays section](#Holidays)

```php
Carbon::setHolidaysRegion('us-national');
echo Carbon::nextCloseIncludingHolidays();
echo $carbonDate->nextCloseIncludingHolidays();
``` 

### Note about timezones

When you set an holidays region, it does not change the timezone, so if January 1st is an holiday,
`->isHoliday()` returns `true` from `Carbon::parse('2010-01-01 00:00:00.000000)` to
`Carbon::parse('2010-01-01 23:59:59.999999)` no matter the timezone you set for those `Carbon`
instance.

If you want to know if it's holiday or business day in somewhere else in the world, you have
to convert it:
```php
Carbon::parse('2010-01-01 02:30', 'Europe/Paris')->setTimezone('America/Toronto')->isHoliday() // false
Carbon::parse('2010-01-01 12:30', 'Europe/Paris')->setTimezone('America/Toronto')->isHoliday() // true
```

The same goes for opening hours, let's say you want to know if you call center based in Toronto is
available from Tokyo at a given hour (Tokyo timezone), you would get something like:
```php
// Opening hours in Toronto
BusinessTime::enable(Carbon::class, [
  'monday' => ['08:00-20:00'],
  'tuesday' => ['08:00-20:00'],
  'wednesday' => ['08:00-20:00'],
  'thursday' => ['08:00-20:00'],
]);
// Can I call the hotline if it's Tuesday 19:30 in Tokyo? > No
Carbon::parse('2019-03-05 20:30', 'Asia/Tokyo')->setTimezone('America/Toronto')->isOpen() // false
// Can I call the hotline if it's Tuesday 22:30 in Tokyo? > Yes
Carbon::parse('2019-03-05 22:30', 'Asia/Tokyo')->setTimezone('America/Toronto')->isOpen() // true
```
