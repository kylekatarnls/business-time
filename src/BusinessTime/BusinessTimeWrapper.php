<?php

namespace BusinessTime;

use BadMethodCallException;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Cmixin\BusinessTime;

final class BusinessTimeWrapper extends BusinessTime
{
    /** @var array|null */
    private $methods = null;

    public static function create(array $openingHours): self
    {
        $businessTime = new self();
        $parser = new DefinitionParser($businessTime, $openingHours, function ($date) {
            if ($date instanceof CarbonInterface) {
                try {
                    $hasMacro = $date->hasLocalMacro('isHoliday');
                } catch (BadMethodCallException $exception) {
                    $hasMacro = false;
                }

                if ($hasMacro) {
                    return $date->isHoliday();
                }
            }

            $className = method_exists(static::class, 'instance') ? static::class : CarbonImmutable::class;

            return $className::instance($date)->isHoliday();
        });
        $businessTime->openingHours = $parser->getEmbeddedOpeningHours($businessTime);

        return $businessTime;
    }

    public function getMethods(): array
    {
        if ($this->methods !== null) {
            return $this->methods;
        }

        $this->methods = [];

        foreach (get_class_methods(parent::class) as $method) {
            if (substr($method, 0, 2) === '__') {
                continue;
            }

            $this->methods[$method] = $this->$method();
        }

        return $this->methods;
    }
}
