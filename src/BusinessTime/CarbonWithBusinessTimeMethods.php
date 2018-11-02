<?php

namespace BusinessTime;

use Carbon\Carbon;

/**
 * Class CarbonWithBusinessTimeMethods to use as type annotation for fluid chaining.
 *
 * @method mixed safeCallOnOpeningHours(string $method, ...$arguments)
 */
class CarbonWithBusinessTimeMethods extends Carbon
{
}
