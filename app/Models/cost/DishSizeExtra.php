<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class DishSizeExtra extends Model
{    use baseTrait;

    public  function extraSize(){
        return $this->belongsTo(DishSize::class,'extra_id');
    }

    public  function DishSize(){
        return $this->belongsTo(DishSize::class);
    }
}
