<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use baseTrait, restaurantScopeTrait;

    protected $rules = array(
        'name'              =>  'required|string',
        'description'       =>  'nullable|string',
        'from'              =>  'required|date',
        'to'                =>  'required|date',
        'percentage'        =>  'required|numeric',
    );
}
