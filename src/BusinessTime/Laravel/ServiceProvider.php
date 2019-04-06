<?php

namespace BusinessTime\Laravel;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Closure;
use Cmixin\BusinessTime;
use Illuminate\Support\Facades\Date;

/**
 * @property \App $app
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $config = $this->app->get('config');
        $config = $config->get('carbon.opening-hours') ?: $config->get('carbon.opening_hours');

        if ($config instanceof Closure) {
            $config = $config($this->app);
        }

        if (is_array($config)) {
            BusinessTime::enable(
                array_filter([
                    Carbon::class,
                    CarbonImmutable::class,
                    Date::class,
                ], 'class_exists'),
                $config
            );
        }
    }

    public function register()
    {
        // Needed for Laravel < 5.3 compatibility
    }
}
