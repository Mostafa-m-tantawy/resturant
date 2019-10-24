<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishSizeSide extends Model
{
    public  function sideSize(){
return $this->belongsTo(DishSize::class,'side_id');
    }

    public  function DishSize(){
return $this->belongsTo(DishSize::class);
    }
}
