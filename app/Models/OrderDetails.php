<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //

    public  function  dishSize(){
return $this->belongsTo(DishSize::class);
    }

}
