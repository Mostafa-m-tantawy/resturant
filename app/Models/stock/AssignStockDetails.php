<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class AssignStockDetails extends Model
{
    use baseTrait;

    public function assignHeader(){
        return $this->belongsTo(AssignStock::class,'assign_stock_id');
    }
    public function product(){
        return $this->belongsTo(Product::class);

    }
}
