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
            $classes = array_filter([
                Carbon::class,
                CarbonImmutable::class,
                Illuminate\Support\Carbon::class,
            ], 'class_exists');

            // @codeCoverageIgnoreStart
            if (class_exists(Date::class) &&
                (($now = Date::now()) instanceof \DateTimeInterface) &&
                !in_array($class = get_class($now), $classes)) {
                $classes[] = $class;
            }
            // @codeCoverageIgnoreEnd

            BusinessTime::enable($classes, $config);
        }
    }

    public function register()
    {
        // Needed for Laravel < 5.3 compatibility
    }
}
