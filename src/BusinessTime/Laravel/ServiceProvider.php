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
        $config = $this->proceedConfig($config->get('carbon') ?: $config->get('carbon'));

        if (!is_array($config)) {
            return;
        }

        $openingHours = $this->proceedConfig($config['opening-hours'] ?? $config['opening_hours'] ?? []);
        unset($config['opening-hours'], $config['opening_hours']);

        BusinessTime::enable(
            $this->getCarbonClasses(),
            array_merge($config, $openingHours)
        );
    }

    public function register()
    {
        // Needed for Laravel < 5.3 compatibility
    }

    private function proceedConfig($config)
    {
        if ($config instanceof Closure) {
            return $config($this->app);
        }

        return $config;
    }

    private function getCarbonClasses(): array
    {
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

        return $classes;
    }
}
