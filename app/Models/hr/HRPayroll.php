<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrPayroll extends Model
{
    use baseTrait,restaurantScopeTrait;


    public  function payslips(){
        return $this->hasMany(HrPayslip::class,'hr_payroll_id');
    }   public  function approveRequest(){
        return $this->morphMany(HrApprovalRequest::class,'approvable');
    }
}
