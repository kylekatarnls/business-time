<?php

namespace BusinessTime;

final class Normalizer
{
    public static function normalizeDay(
        $day,
        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']
    ) {
        if (is_int($day)) {
            $day %= 7;
            if ($day < 0) {
                $day += 7;
            }

            return $days[$day];
        }

        return strtolower($day);
    }
}
