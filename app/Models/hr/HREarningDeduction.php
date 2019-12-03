<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class HrEarningDeduction extends Model
{    use baseTrait,restaurantScopeTrait;


    protected $rules = array(
        'type'          =>  'required|string|max:255',
        'name'        =>  'required|string|max:255',
    );}
