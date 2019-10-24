<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishSizeRecipe extends Model
{
    public function dishSize(){
        return $this->belongsTo(DishSize::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
