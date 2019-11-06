<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class AssignStock extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
    public function assignable(){
        return $this->morphTo();
    }
    public function sourceable(){
        return $this->morphTo();
    }
    public function details(){
        return $this->hasMany(AssignStockDetails::class);
    }
}
