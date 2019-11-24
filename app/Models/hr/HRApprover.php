<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrApprover extends Model
{
    use baseTrait,restaurantScopeTrait;
    protected $rules = array(
        'level'             =>  'required|Integer',
        'approver'             =>  'required|Integer',
        'hr_approval_type_id'  =>  'required|Integer',
    );

    public  function employee(){
        return $this->belongsTo(HrEmployee::class,'hr_employee_id');
    }
    public  function approveType(){
        return $this->belongsTo(HrApprovalType::class,'hr_approval_type_id');
    }
    public  function approve(){
        return $this->hasMany(HrApprove::class,'hr_approver_id');
    }
}
