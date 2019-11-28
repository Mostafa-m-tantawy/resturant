<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrShift extends Model
{
    use baseTrait,restaurantScopeTrait;

    protected $rules = array(
        'name'          => 'required|string|max:255',
        'type'          => 'required|string',
        'threshold'     => 'nullable|Integer',
    );

    public function hours(){
        return $this->hasMany(HrShiftHour::class,'hr_shift_id');
    }
    public function employees(){
        return $this->belongsToMany(HrEmployee::class,'employee_shift','hr_employee_id','hr_shift_id');
    }
    public function lastShiftHors(){
    return $this->hours->last();
}
}
