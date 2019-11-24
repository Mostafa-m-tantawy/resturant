<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Http\Traits\uploadFileTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use uploadFileTrait, baseTrait,restaurantScopeTrait;


    //
    public function sender(){
        return $this->belongsTo(Restaurant::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(Supplier::class,'receiver_id');
    }


}
