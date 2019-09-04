<?php

namespace App;

use BenSampo\Enum\Traits\CastsEnums;
use App\Enums\RepeatType;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use CastsEnums;

    protected $enumCasts = [
        'repeat_type' => RepeatType::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'reccurence_rules',
        'timeframe', 'coping', 'memo',
        'start_date', 'end_date',
    ];

    //命名要検討
    public function setRrules()
    {
        $parse_rule = app('App\Http\Controllers\RruleController')
            ->parseRrules($this);
            
        $this->interval    = $parse_rule['interval'];
        $this->day         = $parse_rule['day'];
        $this->repeat_type = $parse_rule['repeat_type'];
    }

}
