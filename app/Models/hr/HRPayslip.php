<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrPayslip extends Model
{
    use baseTrait, restaurantScopeTrait;
    protected $rules = array(

        'employee' => 'required|Integer',

    );

    public function approve_request()
    {
        return $this->morphOne(HrApprovalRequest::class, 'approvable');
    }


    public function getStatusAttribute()
    {

        return $approve_request = $this->approve_request->status;
    }


    public function payroll()
    {

        return $this->belongsTo(HrPayroll::class, 'hr_payroll_id');
    }


    public function employee()
    {
        return $this->belongsTo(HrEmployee::class, 'hr_employee_id');

    }
}
