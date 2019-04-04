<?php

include __DIR__.'/vendor/autoload.php';
include __DIR__.'/vendor/cmixin/business-day/src/Types/Generator.php';

$sources = __DIR__.'/src';
$generator = new \Types\Generator();
$generator->writeHelpers(\Cmixin\BusinessTime::class, $sources, $sources, '_ide_business_time', function () {
    \Cmixin\BusinessTime::enable(\Carbon\Carbon::class);
});
