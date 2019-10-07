<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignStock extends Model
{
    public function assignable(){
        return $this->morphTo();
    }
}
