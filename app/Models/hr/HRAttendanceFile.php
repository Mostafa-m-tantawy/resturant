<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrAttendanceFile extends Model
{
    use baseTrait,restaurantScopeTrait;

}
