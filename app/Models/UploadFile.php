<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    public function filable(){
        return $this->morphTo();
    }


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
}
