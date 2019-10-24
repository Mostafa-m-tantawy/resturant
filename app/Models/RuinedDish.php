<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class RuinedDish extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }}
