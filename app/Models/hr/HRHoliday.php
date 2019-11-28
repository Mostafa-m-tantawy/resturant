<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrHoliday extends Model
{
    use baseTrait,restaurantScopeTrait;
    protected $rules = array(
        'name'  => 'required|string|max:255',
        'from'  => 'required|date',
        'to'    => 'required|date|after:from',
    );
}
