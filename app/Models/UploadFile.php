<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{    use baseTrait,restaurantScopeTrait;

    public function filable(){
        return $this->morphTo();
    }



}
