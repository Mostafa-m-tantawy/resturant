<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class CookedProduct extends Model
{
    use baseTrait;

public function dishSize(){

    return $this->belongsTo(DishSize::class);
}
public function product(){

    return $this->belongsTo(Product::class);
}
}
