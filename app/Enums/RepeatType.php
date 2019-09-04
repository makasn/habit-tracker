<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class RepeatType extends Enum implements LocalizedEnum
{
    const DAY      = 'day';
    const INTERVAL = 'interval';
    const COUNT    = 'count';
}
