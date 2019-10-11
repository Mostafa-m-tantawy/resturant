<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function RuinedHeader(){
        return $this->morphTo(RuinedHeader::class,'ruinedable');
    }
}
