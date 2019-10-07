<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public function sender(){
        return $this->belongsTo(Restaurant::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(Supplier::class,'receiver_id');
    }
}
