<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrShiftHour extends Model
{
    use baseTrait,restaurantScopeTrait;

    protected $rules = array(
        'shift_id'      => 'required|integer',
        'start_day'     => 'required|string',
        'start_time'    => 'required|date_format:H:i',
        'end_day'       => 'required|string',
        'end_time'      => 'required|date_format:H:i',
    );
}
