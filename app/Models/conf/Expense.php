<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Http\Traits\uploadFileTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use uploadFileTrait,baseTrait,restaurantScopeTrait,SoftDeletes;


    //
public function restaurant(){
    return $this->belongsTo(Restaurant::class);
}

}
