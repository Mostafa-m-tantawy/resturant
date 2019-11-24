<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class HrEmergencyContact extends Model
{
       use baseTrait;

    protected $rules = array(
        'name'        => 'required|string|max:255',
        'phone'       => 'required|string|max:255',
        'email'       => 'nullable|email',
        'relationship'    => 'required|string|max:255',
        'address'     => 'required|string|max:255',
    );

    public  function employee(){

        return $this->belongsTo(HrEmployee::class,'hr_employee_id');

    }
}
