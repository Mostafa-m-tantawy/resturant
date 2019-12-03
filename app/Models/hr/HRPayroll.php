<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrPayroll extends Model
{
    use baseTrait,restaurantScopeTrait;

    protected $rules = array(
        'type'   => 'required|Integer',
        'from'      => 'required|date',
        'to'        => 'required|date|after:from',
    );

    public  function payslips(){
        return $this->hasMany(HrPayslip::class,'hr_payroll_id');
    }

   public  function type(){
        return $this->belongsTo(HrPayrollType::class,'hr_payroll_type_id');
    }



    public  function approve_request(){
        return $this->morphMany(HrApprovalRequest::class,'approvable');
    }




    public function getStatusAttribute()
    {

        return $approve_request = $this->approve_request->status;
    }


}
