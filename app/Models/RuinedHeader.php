<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RuinedHeader extends Model
{
    //
    protected $table='ruined_headers';
    public  function ruinedable(){
        return $this->morphTo();
    }
}
