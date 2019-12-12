<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use baseTrait,restaurantScopeTrait;

}
