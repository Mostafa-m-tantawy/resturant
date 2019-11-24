<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use baseTrait,restaurantScopeTrait;

    public  function  sizes(){
        return $this->hasMany(DishSize::class);
    }
   public  function  department(){
        return $this->belongsTo(Department::class);
    }

}
