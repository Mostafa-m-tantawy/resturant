<?php

namespace App;

use App\Http\Traits\uploadFileTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use uploadFileTrait;

    //
public function restaurant(){
    return $this->belongsTo(Restaurant::class);
}

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
}
