<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function RuinedHeader(){
        return $this->morphTo(RuinedHeader::class,'ruinedable');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
}
