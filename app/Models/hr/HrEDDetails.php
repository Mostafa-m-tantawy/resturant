<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class HrEDDetails extends Model
{    use baseTrait;


    protected $rules = array(
        'type'          =>  'required|numeric',
        'payroll'        =>  'required|numeric',
        'employee'        =>  'required|numeric',
        'reason'        =>  'required|string|max:255',
        'amount'        =>  'required|numeric',
    );

public function header(){
    return $this->belongsTo(HrEarningDeduction::class,'hr_earning_deduction_id');
}
public function payslip(){
    return $this->belongsTo(HrPayslip::class,'hr_payslip_id');
}
public function type(){
    return $this->belongsTo(HrEarningDeduction::class,'hr_earning_deduction_id');
}
}
