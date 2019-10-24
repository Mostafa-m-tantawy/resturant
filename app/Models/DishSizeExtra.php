<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishSizeExtra extends Model
{
    public  function extraSize(){
        return $this->belongsTo(DishSize::class,'extra_id');
    }

    public  function DishSize(){
        return $this->belongsTo(DishSize::class);
    }
}
