<?php

namespace App;

use App\Http\Traits\baseTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use baseTrait;

    public function hall(){
        return $this->belongsTo(Hall::class);
    }
}
