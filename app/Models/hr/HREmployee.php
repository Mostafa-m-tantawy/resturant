<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class HrEmployee extends Model
{

    use baseTrait;

    protected $rules = array(


        'name' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone_g.*.phone' => ['required'],
        'phone_g.*.type' => ['required'],
        'address_g.*.address' => ['required'],

    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function emergencies()
    {
        return $this->hasMany(HrEmergencyContact::class);
    }

    public function requests()
    {
        return $this->hasMany(HrApprovalRequest::class,'hr_employee_id');
    }


}
