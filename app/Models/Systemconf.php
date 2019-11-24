<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class SystemConf extends Model
{    use baseTrait,restaurantScopeTrait;

    protected $fillable=['name','value','restaurant_id'];


}
