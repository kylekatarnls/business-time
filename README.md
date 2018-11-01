# business-time

Carbon mixin to handle business days and opening hours

[![Latest Stable Version](https://poser.pugx.org/cmixin/business-time/v/stable.png)](https://packagist.org/packages/cmixin/business-time)
[![Build Status](https://travis-ci.org/kylekatarnls/business-time.svg?branch=master)](https://travis-ci.org/kylekatarnls/business-time)
[![Code Climate](https://codeclimate.com/github/kylekatarnls/business-time/badges/gpa.svg)](https://codeclimate.com/github/kylekatarnls/business-time)
[![Test Coverage](https://codeclimate.com/github/kylekatarnls/business-time/badges/coverage.svg)](https://codeclimate.com/github/kylekatarnls/business-time/coverage)
[![Issue Count](https://codeclimate.com/github/kylekatarnls/business-time/badges/issue_count.svg)](https://codeclimate.com/github/kylekatarnls/business-time)
[![StyleCI](https://styleci.io/repos/129502391/shield?branch=master)](https://styleci.io/repos/129502391)

## Install

```
composer require cmixin/business-time
```

## Usage

First load the mixin in some global bootstrap place of your app:

```php
<?php

use Cmixin\BusinessTime;

BusinessTime::enable('Carbon\Carbon');
// Or if you use Laravel:
// BusinessDay::enable('Illuminate\Support\Carbon');

// As a second argument you can set default opening hours:
BusinessTime::enable('Carbon\Carbon', [
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
```

Business days methods are now available on any Carbon instance
used anywhere later.
