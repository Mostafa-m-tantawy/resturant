<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use baseTrait,restaurantScopeTrait;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
