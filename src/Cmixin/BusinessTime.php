<?php

namespace Cmixin;

use BusinessTime\MixinBase;
use BusinessTime\Traits\AddAndSubtract;
use BusinessTime\Traits\ClosedOr;
use BusinessTime\Traits\CurrentOr;
use BusinessTime\Traits\Diff;
use BusinessTime\Traits\Holidays;
use BusinessTime\Traits\IsMethods;
use BusinessTime\Traits\OpenClose;
use BusinessTime\Traits\OpenOr;
use BusinessTime\Traits\Range;

class BusinessTime extends MixinBase
{
    use AddAndSubtract;
    use ClosedOr;
    use CurrentOr;
    use Diff;
    use Holidays;
    use IsMethods;
    use OpenClose;
    use OpenOr;
    use Range;
}
