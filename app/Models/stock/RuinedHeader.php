<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class RuinedHeader extends Model
{
    use baseTrait,restaurantScopeTrait;

    protected $table='ruined_headers';
    public  function ruinedable(){
        return $this->morphTo();
    }
    public  function products(){
        return $this->hasMany(RuinedProduct::class,'ruined_header_id');
    }

}
