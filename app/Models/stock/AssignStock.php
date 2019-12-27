<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class AssignStock extends Model
{

    use baseTrait,restaurantScopeTrait;

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
