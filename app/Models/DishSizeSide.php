<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class DishSizeSide extends Model
{    use baseTrait;

    public  function sideSize(){
return $this->belongsTo(DishSize::class,'side_id');
    }

    public  function DishSize(){
return $this->belongsTo(DishSize::class);
    }
}
