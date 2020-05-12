<?php

namespace Cmixin;

use BusinessTime\MixinBase;
use BusinessTime\Traits\Add;
use BusinessTime\Traits\ClosedOr;
use BusinessTime\Traits\CurrentOr;
use BusinessTime\Traits\Holidays;
use BusinessTime\Traits\IsMethods;
use BusinessTime\Traits\OpenClose;
use BusinessTime\Traits\OpenOr;
use BusinessTime\Traits\Range;
use BusinessTime\Traits\Subtract;

class BusinessTime extends MixinBase
{
    use Add;
    use ClosedOr;
    use CurrentOr;
    use Holidays;
    use IsMethods;
    use OpenClose;
    use OpenOr;
    use Range;
    use Subtract;
}
