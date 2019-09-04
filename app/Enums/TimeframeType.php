<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TimeframeType extends Enum
{
    const MORNING   = 'morning';
    const AFTERNOON = 'afternoon';
    const EVENING   = 'evening';
    const ANYTIME   = 'anytime';
}
