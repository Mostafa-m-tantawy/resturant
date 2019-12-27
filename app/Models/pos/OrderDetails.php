<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use baseTrait;


    public function dishSize()
    {
        return $this->belongsTo(DishSize::class);
    }

    public function sides()
    {
        return $this->hasMany(OrderDetails::class, 'parent_id')
            ->where('type', 'side')->with(['dishSize' => function ($query) {

                    $query->with('dish');

            }]);
    }

    public function extras()
    {
        return $this->hasMany(OrderDetails::class, 'parent_id')
            ->where('type', 'extra')->with(['dishSize' => function ($query) {
                    $query->with('dish');

            }]);

    }
}
