<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class HrLeaveType extends Model
{
    use baseTrait,restaurantScopeTrait;

    protected $rules = array(
        'name'  => 'required|string|max:255',
        'type'  => 'required|string',
    );



}
