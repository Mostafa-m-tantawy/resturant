<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class DishCategory extends Model
{    use baseTrait,restaurantScopeTrait;

    public function dishes(){
        return $this->hasMany(Dish::class);
    }


}
