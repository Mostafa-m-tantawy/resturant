<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public  function  sizes(){
        return $this->hasMany(DishSize::class);
    }
   public  function  department(){
        return $this->belongsTo(Department::class);
    }


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
}
