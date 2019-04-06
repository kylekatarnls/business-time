<?php

class App
{
    public $hours = [
        'monday' => ['08:00-12:00'],
    ];

    public function get($name)
    {
        return $name === 'config' ? $this : function ($app) {
            return $app->hours;
        };
    }
}
