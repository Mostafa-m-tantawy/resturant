<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model
{
    use baseTrait;

    protected $rules = array(
        'amount'             =>  'required|numeric',
        'payment_method'             =>  'required|string',
        'note'  =>  'nullable|string',
    );
}
