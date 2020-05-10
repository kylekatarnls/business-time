# business-time

[Carbon](https://carbon.nesbot.com/) mixin to handle business days and opening hours

[![Latest Stable Version](https://poser.pugx.org/cmixin/business-time/v/stable.png)](https://packagist.org/packages/cmixin/business-time)
[![Build Status](https://travis-ci.org/kylekatarnls/business-time.svg?branch=master)](https://travis-ci.org/kylekatarnls/business-time)
[![Code Climate](https://codeclimate.com/github/kylekatarnls/business-time/badges/gpa.svg)](https://codeclimate.com/github/kylekatarnls/business-time)
[![Test Coverage](https://codeclimate.com/github/kylekatarnls/business-time/badges/coverage.svg)](https://codeclimate.com/github/kylekatarnls/business-time/coverage)
[![Issue Count](https://codeclimate.com/github/kylekatarnls/business-time/badges/issue_count.svg)](https://codeclimate.com/github/kylekatarnls/business-time)
[![StyleCI](https://styleci.io/repos/155368756/shield?branch=master&style=flat)](https://styleci.io/repos/155368756)

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

// And you can enable multiple classes at once:
BusinessTime::enable([
    Carbon::class,
    CarbonImmutable::class,
]);

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

[Try in the live editor](https://try-carbon.herokuapp.com/?input=BusinessTime%3A%3Aenable(Carbon%3A%3Aclass%2C%20%5B%0D%0A%20%20%27monday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-18%3A00%27%5D%2C%0D%0A%20%20%27tuesday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-18%3A00%27%5D%2C%0D%0A%20%20%27wednesday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%5D%2C%0D%0A%20%20%27thursday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-18%3A00%27%5D%2C%0D%0A%20%20%27friday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-20%3A00%27%5D%2C%0D%0A%20%20%27saturday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-16%3A00%27%5D%2C%0D%0A%20%20%27sunday%27%20%3D%3E%20%5B%5D%2C%0D%0A%20%20%27exceptions%27%20%3D%3E%20%5B%0D%0A%20%20%20%20%272016-11-11%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%5D%2C%0D%0A%20%20%20%20%272016-12-25%27%20%3D%3E%20%5B%5D%2C%0D%0A%20%20%20%20%2701-01%27%20%3D%3E%20%5B%5D%2C%20%2F%2F%20Recurring%20on%20each%201st%20of%20january%0D%0A%20%20%20%20%2712-25%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%5D%2C%20%2F%2F%20Recurring%20on%20each%2025th%20of%20december%0D%0A%20%20%5D%2C%0D%0A%20%20%27holidays%27%20%3D%3E%20%5B%0D%0A%20%20%20%20%27region%27%20%3D%3E%20%27us-ny%27%2C%20%2F%2F%20Load%20the%20official%20list%20of%20holidays%20from%20USA%20-%20New%20York%0D%0A%20%20%20%20%27with%27%20%3D%3E%20%5B%0D%0A%20%20%20%20%20%20%27labor-day%27%20%3D%3E%20null%2C%20%2F%2F%20Remove%20the%20Labor%20Day%20(so%20the%20business%20is%20open)%0D%0A%20%20%20%20%20%20%27company-special-holiday%27%20%3D%3E%20%2704-07%27%2C%20%2F%2F%20Add%20some%20custom%20holiday%20of%20your%20company%20%0D%0A%20%20%20%20%5D%2C%0D%0A%20%20%5D%2C%0D%0A%5D)%3B%0D%0A%0D%0A%24date%20%3D%20Carbon%3A%3Aparse(%272019-04-01%2017%3A25%27)%3B%0D%0A%0D%0Avar_dump(%24date-%3EisOpen())%3B%0D%0Aecho%20%24date-%3EnextClose().%22%5Cn%22%3B%0D%0A%0D%0A%24date%20%3D%20Carbon%3A%3Aparse(%272019-04-01%2018%3A25%27)%3B%0D%0A%0D%0Avar_dump(%24date-%3EisOpen())%3B%0D%0Aecho%20%24date-%3EnextOpen().%22%5Cn%22%3B%0D%0A%0D%0A%2F%2F%20Exception%20for%20Christmas%0D%0A%24date%20%3D%20Carbon%3A%3Aparse(%272019-12-25%2017%3A25%27)%3B%0D%0A%0D%0Avar_dump(%24date-%3EisOpen())%3B%0D%0A%0D%0A%24date%20%3D%20Carbon%3A%3Aparse(%272019-12-25%2011%3A25%27)%3B%0D%0A%0D%0Avar_dump(%24date-%3EisOpen())%3B%0D%0A%0D%0A%24date%20%3D%20Carbon%3A%3Aparse(%272018-04-07%2011%3A25%27)%3B%0D%0A%0D%0Avar_dump(%24date-%3EisBusinessOpen())%3B%20%2F%2F%20use%20isBusinessOpen%20to%20consider%20holidays%20as%20closed%20all%20day%20long%0D%0A)

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

[Try in the live editor](https://try-carbon.herokuapp.com/?input=BusinessTime%3A%3Aenable(Carbon%3A%3Aclass%2C%20%5B%0D%0A%20%20%27monday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-18%3A00%27%5D%2C%0D%0A%20%20%27tuesday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-18%3A00%27%5D%2C%0D%0A%20%20%27wednesday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%5D%2C%0D%0A%20%20%27thursday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-18%3A00%27%5D%2C%0D%0A%20%20%27friday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-20%3A00%27%5D%2C%0D%0A%20%20%27saturday%27%20%3D%3E%20%5B%2709%3A00-12%3A00%27%2C%20%2713%3A00-16%3A00%27%5D%2C%0D%0A%20%20%27sunday%27%20%3D%3E%20%5B%5D%2C%0D%0A%20%20%27exceptions%27%20%3D%3E%20%5B%0D%0A%20%20%20%20function%20(Carbon%20%24date)%20%7B%0D%0A%20%20%20%20%20%20if%20(%24date-%3EisHoliday())%20%7B%0D%0A%20%20%20%20%20%20%20%20%2F%2F%20Or%20use%20-%3EisObservedHoliday()%20and%20set%20observed%20holidays%3A%0D%0A%20%20%20%20%20%20%20%20%2F%2F%20https%3A%2F%2Fgithub.com%2Fkylekatarnls%2Fbusiness-day%23setobservedholidayszone%0D%0A%20%20%20%20%20%20%20%20switch%20(%24date-%3EgetHolidayId())%20%7B%0D%0A%20%20%20%20%20%20%20%20%20%20%2F%2F%20If%20the%20ID%20%22christmas%22%20exists%20in%20the%20selected%20holidays%20region%20and%20matches%20the%20current%20date%3A%0D%0A%20%20%20%20%20%20%20%20%20%20case%20%27christmas%27%3A%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20return%20%5B%2710%3A00-12%3A00%27%5D%3B%0D%0A%20%20%20%20%20%20%20%20%20%20default%3A%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20return%20%5B%5D%3B%20%2F%2F%20All%20other%20holidays%20are%20closed%20all%20day%20long%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%2F%2F%20Here%20you%20can%20also%20pass%20context%20data%3A%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20return%20%5B%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%27hours%27%20%3D%3E%20%5B%5D%2C%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%27data%27%20%20%3D%3E%20%5B%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%27reason%27%20%3D%3E%20%27Today%20is%20%27%20.%20%24date-%3EgetHolidayName()%2C%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%20%20%5D%2C%0D%0A%20%20%20%20%20%20%20%20%20%20%20%20%5D%3B%0D%0A%20%20%20%20%20%20%20%20%7D%0D%0A%20%20%20%20%20%20%7D%0D%0A%20%20%20%20%20%20%2F%2F%20Else%2C%20typical%20day%20%3D%3E%20use%20days%20of%20week%20settings%0D%0A%20%20%20%20%7D%2C%0D%0A%20%20%5D%2C%0D%0A%5D)%3B%0D%0A%0D%0ACarbon%3A%3AsetHolidaysRegion(%27us-national%27)%3B%0D%0A%0D%0Avar_dump(Carbon%3A%3Aparse(%272018-12-25%2011%3A00%27)-%3EisOpen())%3B%20%2F%2F%20true%20%20matches%20custom%20opening%20hours%20of%20Christmas%0D%0Avar_dump(Carbon%3A%3Aparse(%272018-12-25%2013%3A00%27)-%3EisOpen())%3B%20%2F%2F%20false%0D%0Avar_dump(Carbon%3A%3Aparse(%272019-01-01%2011%3A00%27)-%3EisOpen())%3B%20%2F%2F%20false%20closed%20all%20day%20long%0D%0Avar_dump(Carbon%3A%3Aparse(%272019-01-02%2011%3A00%27)-%3EisOpen())%3B%20%2F%2F%20true%20%20not%20an%20holiday%20in%20us-national%20region%2C%20so%20it%27s%20open%20as%20any%20common%20wednesday)

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

### previousOpen

Go to previous open-business time.

```php
Carbon::previousOpen()       // go to previous open time from now
$carbonDate->previousOpen()  // go to previous open time from $carbonDate
``` 

### previousClose

Go to previous closed-business time.

```php
Carbon::previousClose()       // go to previous close time from now
$carbonDate->previousClose()  // go to previous close time from $carbonDate
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

[Try in the live editor](https://try-carbon.herokuapp.com/?input=BusinessTime%3A%3Aenable(Carbon%3A%3Aclass%2C%20%5B%0D%0A%20%20%27monday%27%20%3D%3E%20%5B%0D%0A%20%20%20%20%27data%27%20%3D%3E%20%5B%0D%0A%20%20%20%20%20%20%27remarks%27%20%3D%3E%20%27Extra%20evening%20on%20Monday%27%2C%0D%0A%20%20%20%20%5D%2C%0D%0A%20%20%20%20%27hours%27%20%3D%3E%20%5B%0D%0A%20%20%20%20%20%20%20%20%2709%3A00-12%3A00%27%2C%0D%0A%20%20%20%20%20%20%20%20%2713%3A00-18%3A00%27%2C%0D%0A%20%20%20%20%20%20%20%20%2719%3A00-20%3A00%27%2C%0D%0A%20%20%20%20%5D%0D%0A%20%20%5D%2C%0D%0A%20%20%2F%2F%20...%0D%0A%5D)%3B%0D%0A%0D%0A%24todayRanges%20%3D%20Carbon%3A%3AgetCurrentDayOpeningHours()%3B%20%2F%2F%20Equivalent%20to%20Carbon%3A%3Anow()-%3EgetCurrentDayOpeningHours()%0D%0A%2F%2F%20You%20can%20also%20get%20opening%20hours%20of%20any%20other%20day%3A%20Carbon%3A%3Aparse(%272018-01-16%27)-%3EgetCurrentDayOpeningHours()%0D%0A%0D%0Aecho%20%22%3Ch1%3EToday%20office%20open%20hours%3C%2Fh1%3E%5Cn%22%3B%0D%0A%24data%20%3D%20%24todayRanges-%3EgetData()%3B%0D%0Aif%20(is_array(%24data)%20%26%26%20isset(%24data%5B%27remarks%27%5D))%20%7B%0D%0A%20%20echo%20%22%3Cp%3E%3Cem%3E%7B%24data%5B%27remarks%27%5D%7D%3C%2Fem%3E%3C%2Fp%3E%5Cn%22%3B%0D%0A%7D%0D%0A%2F%2F%20%24todayRanges%20is%20iterable%20on%20every%20time%20range%20of%20the%20day.%0D%0Aforeach%20(%24todayRanges%20as%20%24range)%20%7B%0D%0A%20%20%2F%2F%20TimeRange%20object%20have%20start%2C%20end%20and%20data%20properties%20but%20can%20also%20be%20implicitly%20converted%20as%20strings%3A%0D%0A%20%20echo%20%22%3Cp%3E%3Ctime%3E%24range%3C%2Ftime%3E%3C%2Fp%3E%5Cn%22%3B%0D%0A%7D%0D%0A%2F%2F%20%24todayRanges%20can%20also%20be%20directly%20dumped%20as%20string%0D%0Aecho%20%22%3Cp%3E%24todayRanges%3C%2Fp%3E%5Cn%22%3B%0D%0A)

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

### nextBusinessOpen / nextOpenExcludingHolidays

Go to next open time (considering all holidays as closed time). But prefer to handle holidays with a dedicated
exception for a finest setting. [See Holidays section](#Holidays)

```php
Carbon::setHolidaysRegion('us-national');
echo Carbon::nextBusinessOpen();
echo $carbonDate->nextBusinessOpen();
``` 

### nextBusinessClose / nextCloseIncludingHolidays

Go to next closed time (considering all holidays as closed time). But prefer to handle holidays with a dedicated
exception for a finest setting. [See Holidays section](#Holidays)

```php
Carbon::setHolidaysRegion('us-national');
echo Carbon::nextBusinessClose();
echo $carbonDate->nextBusinessClose();
``` 

### previousBusinessOpen / previousOpenExcludingHolidays

Go to previous open time (considering all holidays as closed time). But prefer to handle holidays with a dedicated
exception for a finest setting. [See Holidays section](#Holidays)

```php
Carbon::setHolidaysRegion('us-national');
echo Carbon::previousBusinessOpen();
echo $carbonDate->previousBusinessOpen();
``` 

### previousBusinessClose / previousCloseIncludingHolidays

Go to previous closed time (considering all holidays as closed time). But prefer to handle holidays with a dedicated
exception for a finest setting. [See Holidays section](#Holidays)

```php
Carbon::setHolidaysRegion('us-national');
echo Carbon::previousBusinessClose();
echo $carbonDate->previousBusinessClose();
``` 

### currentOr*

Methods starting with `currentOr` are followed by:
  - a **time-direction**: `Next` / `Previous`
  - optionally `Business` (meaning holidays are automatically considered as closed)
  - a **state** `Open` / `Close`

All `currentOr*` methods return the current date-time if it's in the **state**
(see above), else they return the first date-time (next or previous according
to the given **time-direction**) where a state change to be the chosen **state**
(open / close).

Note: `BusinessOpen` can also be written explicitly as `OpenExcludingHolidays`
and `BusinessClose` as `CloseIncludingHolidays`.

### openOr*

Methods starting with `openOr` are followed by:
  - a **time-direction**: `Next` / `Previous`
  - optionally `Business` (meaning holidays are automatically considered as closed)
  - `Close` (for open-or-next/previous-open, [see currentOr*](#currentOr*))

All `openOr*` methods return the current date-time if it's open, else
they return the first date-time (next or previous according
to the given **time-direction**) the business close.

Note: `BusinessClose` can also be written explicitly as `CloseIncludingHolidays`.
 
### closedOr*

Methods starting with `closedOr` are followed by:
  - a **time-direction**: `Next` / `Previous`
  - optionally `Business` (meaning holidays are automatically considered as closed)
  - `Open` (for closed-or-next/previous-closed, [see currentOr*](#currentOr*))

All `closedOr*` methods return the current date-time if it's closed, else
they return the first date-time (next or previous according
to the given **time-direction**) the business open.

Note: `BusinessOpen` can also be written explicitly as `OpenExcludingHolidays`.

### getCurrentOpenTimeRanges

Get list of ranges that contain the current date-time.

```php
foreach (Carbon::getCurrentOpenTimeRanges() as $timeRange) {
  echo 'From: '.$timeRange->start().' to '.$timeRange->end()."\n";
}
foreach ($carbonDate->getCurrentOpenTimeRanges() as $timeRange) {
  echo 'From: '.$timeRange->start().' to '.$timeRange->end()."\n";
}
``` 

### getCurrentOpenTimeRange

Get the first range that contain the current date-time.

```php
$timeRange = Carbon::getCurrentOpenTimeRange();

if ($timeRange) {
  echo 'From: '.$timeRange->start().' to '.$timeRange->end()."\n";
}

$timeRange = $carbonDate->getCurrentOpenTimeRange();

if ($timeRange) {
  echo 'From: '.$timeRange->start().' to '.$timeRange->end()."\n";
}
``` 

### getCurrentOpenTimeRangeStart

Get the start of the current open time range (if open, holidays ignored).

```php
$start = Carbon::getCurrentOpenTimeRangeStart();

if ($start) {
  echo 'Open since '.$start->format('l H:i')."\n";
} else {
  echo "Closed\n";
}

$start = $carbonDate->getCurrentOpenTimeRangeStart();

if ($start) {
  echo 'Open since '.$start->format('l H:i')."\n";
} else {
   echo "Closed\n";
 }
``` 

### getCurrentOpenTimeRangeEnd

Get the end of the current open time range (if open, holidays ignored).

```php
$end = Carbon::getCurrentOpenTimeRangeEnd();

if ($end) {
  echo 'Will close at '.$start->format('l H:i')."\n";
} else {
  echo "Closed\n";
}

$end = $carbonDate->getCurrentOpenTimeRangeEnd();

if ($end) {
  echo 'Will close at '.$start->format('l H:i')."\n";
} else {
   echo "Closed\n";
 }
``` 

### getCurrentBusinessTimeRangeStart

Get the start of the current open time range (if open and not holiday).

```php
$start = Carbon::getCurrentBusinessTimeRangeStart();

if ($start) {
  echo 'Open since '.$start->format('l H:i')."\n";
} else {
  echo "Closed\n";
}

$start = $carbonDate->getCurrentBusinessTimeRangeStart();

if ($start) {
  echo 'Open since '.$start->format('l H:i')."\n";
} else {
   echo "Closed\n";
 }
``` 

### getCurrentBusinessTimeRangeEnd

Get the end of the current open time range (if open and not holiday).

```php
$end = Carbon::getCurrentBusinessTimeRangeEnd();

if ($end) {
  echo 'Will close at '.$start->format('l H:i')."\n";
} else {
  echo "Closed\n";
}

$end = $carbonDate->getCurrentBusinessTimeRangeEnd();

if ($end) {
  echo 'Will close at '.$start->format('l H:i')."\n";
} else {
   echo "Closed\n";
 }
``` 

### Laravel

To enable business-time globally in Laravel, set default openning hours and holidays settings in the config file
**config/carbon.php** (create this file if it does not exist yet):

```php
<?php return [
  'opening-hours' => [
    'monday' => ['08:00-12:00', '14:00-19:00'],
    'wednesday' => ['09:00-19:00'],
  ],
  'holidays' => [
    'region' => 'us',
    'with' => [
      'boss-birthday' => '09-26',
      'last-monday'   => '= last Monday of October',
    ],
  ],
];
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

[Try in the live editor](https://try-carbon.herokuapp.com/?input=%2F%2F%20Opening%20hours%20in%20Toronto%0D%0ABusinessTime%3A%3Aenable(Carbon%3A%3Aclass%2C%20%5B%0D%0A%20%20%27monday%27%20%3D%3E%20%5B%2708%3A00-20%3A00%27%5D%2C%0D%0A%20%20%27tuesday%27%20%3D%3E%20%5B%2708%3A00-20%3A00%27%5D%2C%0D%0A%20%20%27wednesday%27%20%3D%3E%20%5B%2708%3A00-20%3A00%27%5D%2C%0D%0A%20%20%27thursday%27%20%3D%3E%20%5B%2708%3A00-20%3A00%27%5D%2C%0D%0A%5D)%3B%0D%0A%2F%2F%20Can%20I%20call%20the%20hotline%20if%20it%27s%20Tuesday%2019%3A30%20in%20Tokyo%3F%20%3E%20No%0D%0Avar_dump(Carbon%3A%3Aparse(%272019-03-05%2020%3A30%27%2C%20%27Asia%2FTokyo%27)-%3EsetTimezone(%27America%2FToronto%27)-%3EisOpen())%3B%0D%0A%2F%2F%20Can%20I%20call%20the%20hotline%20if%20it%27s%20Tuesday%2022%3A30%20in%20Tokyo%3F%20%3E%20Yes%0D%0Avar_dump(Carbon%3A%3Aparse(%272019-03-05%2022%3A30%27%2C%20%27Asia%2FTokyo%27)-%3EsetTimezone(%27America%2FToronto%27)-%3EisOpen())%3B%0D%0A%0D%0A%2F%2F%20Is%20it%20now%20open%20in%20Toronto%3F%20%3E%20It%20depends%20on%20when%20you%20will%20run%20this%20code%0D%0Avar_dump(Carbon%3A%3Anow(%27America%2FToronto%27)-%3EisOpen())%3B%0D%0A)
