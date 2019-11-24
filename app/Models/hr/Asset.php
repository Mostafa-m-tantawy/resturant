<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use baseTrait,restaurantScopeTrait;

    protected $rules = array(
        'name'             =>  'required|string',
        'description'             =>  'required|string',
        'cost'  =>  'required|Integer',
    );
    function employees(){
        return $this->belongsToMany(HrEmployee::class,
            'hr_asset_employee','hr_employee_id',
            'asset_id')
            ->withPivot('date_of_assignment','date_of_release');
    }
}
