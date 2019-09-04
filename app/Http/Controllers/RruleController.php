<?php

namespace App\Http\Controllers;

use App\Enums\RepeatType;

class RruleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function buildIntervalRule($interval)
    {
        $rule = (new \Recurr\Rule)->setFreq('DAILY');

        if (!$interval) {
            return $rule->getString();
        }

        $rule->setInterval($interval);
        return $rule->getString();
    }

    public function buildByDayRule($days)
    {
        $rule = (new \Recurr\Rule)->setFreq('DAILY');

        if (!$days) {
            return $rule->getString();
        }

        $rule->setByDay($days);
        return $rule->getString();
    }

    public function parseRrules($habit)
    {
        $rule = new \Recurr\Rule();
        if (isset($habit['reccurence_rules'])) {
            $rule->loadFromString($habit['reccurence_rules']);
        }
        
        $interval = $rule->getInterval();
        $day = $rule->getByDay();
        $repeat_type = RepeatType::DAY;

        if ($interval === 1 && $day) {
            $interval = null;
        }

        if (!$day) {
            $day = [];
        }

        if ($habit->interval) {
            $repeat_type = RepeatType::INTERVAL;
        }

        if (!empty($habit->day)) {
            $repeat_type = RepeatType::DAY;
        }

        if ($habit->count_per_week) {
            $repeat_type = RepeatType::COUNT;
        }

        $parse_rule = [
            'interval'     => $interval,
            'day'          => $day,
            'repeat_type' => $repeat_type,
        ];

        return $parse_rule;
    }
}