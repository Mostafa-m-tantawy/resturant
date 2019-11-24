<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrApprovalRequest extends Model
{
    use baseTrait,restaurantScopeTrait;
    protected $guarded = ['id'];


    public function approvable()
    {
        return $this->morphTo();
    }

    public function ApproveType()
    {
        return $this->belongsTo(HrApprovalType::class,'hr_approval_type_id');
    }

    public function whoRequest()
    {
        return $this->belongsTo(HrEmployee::class,'hr_employee_id');
    } public function approver()
    {
        return $this->belongsTo(HrApprover::class,'hr_employee_id');
    }


}
