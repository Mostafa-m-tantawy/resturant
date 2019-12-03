<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrTax extends Model
{
    use baseTrait,restaurantScopeTrait;
    protected $rules = array(
        'name'            => 'required  |   string',
        'percentage'      => 'required  |   numeric',
        'start'           => 'nullable  |   numeric',
        'end'             => 'nullable  |   numeric',
    );

}
