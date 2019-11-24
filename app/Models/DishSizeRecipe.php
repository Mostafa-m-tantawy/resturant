<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class DishSizeRecipe extends Model
{    use baseTrait;

    public function dishSize(){
        return $this->belongsTo(DishSize::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
