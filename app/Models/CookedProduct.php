<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class CookedProduct extends Model
{

public function dishSize(){

    return $this->belongsTo(DishSize::class);
}
public function product(){

    return $this->belongsTo(Product::class);
}
}
