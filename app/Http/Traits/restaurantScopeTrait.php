<?php
namespace App\Http\Traits;


use App\Scopes\restaurantScope;

trait restaurantScopeTrait {

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }


}
