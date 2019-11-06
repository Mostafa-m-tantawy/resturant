<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignStockDetails extends Model
{
    //
    public function assignHeader(){
        return $this->belongsTo(AssignStock::class,'assign_stock_id');
    }
    public function product(){
        return $this->belongsTo(Product::class);

    }
}
