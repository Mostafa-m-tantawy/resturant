<?php
namespace App;

//namespace App\Model;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
}
