<?php
namespace App\Http\Traits;


use App\Restaurant;
use App\Scopes\restaurantScope;

trait restaurantScopeTrait {

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }

public  function restaurant(){
        return $this->belongsTo(Restaurant::class);
}
}
