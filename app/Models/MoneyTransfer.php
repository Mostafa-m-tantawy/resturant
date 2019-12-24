<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyTransfer extends Model
{ use baseTrait,restaurantScopeTrait  , SoftDeletes;
    //

    public function receiver(){
        return $this->belongsTo(HrEmployee::class,'receiver_id');
    }
    public function sender(){
        return $this->belongsTo(HrEmployee::class,'sender_id');
    }

}
