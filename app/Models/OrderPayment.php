<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use baseTrait,restaurantScopeTrait;

    protected $rules = array(
        'order_id'          =>  'required|Integer',
        'amount'            =>  'required|numeric',
        'payment_method'    =>  'required|string',
        'note'              =>  'nullable|string',
    );

}
