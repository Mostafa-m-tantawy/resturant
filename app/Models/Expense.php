<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
public function restaurant(){
    return $this->belongsTo(Restaurant::class);
}
}
