<?php
use App\Enums\RepeatType;

return [
    RepeatType::class => [
        RepeatType::DAY => 'day of week',
        RepeatType::INTERVAL => 'interval days',
        RepeatType::COUNT => 'count per week',
    ],
];