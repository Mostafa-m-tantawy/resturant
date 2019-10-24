<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class RuinedHeader extends Model
{
    //
    protected $table='ruined_headers';
    public  function ruinedable(){
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
}
