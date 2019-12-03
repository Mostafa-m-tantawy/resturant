<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Baklysystems\LaravelHR\Models\ApprovalRequest;
use Illuminate\Database\Eloquent\Model;

class HrLeave extends Model
{
    use baseTrait,restaurantScopeTrait;
    protected $rules = array(
        'type' =>  'required|Integer',
        'from'          =>  'required|date',
        'to'            =>  'required|date',
        'reason'        =>  'required|string',
    );

    public function type(){
        return $this->belongsTo(HrLeaveType::class,'hr_leave_type_id');
    }

    public function approve_request()
    {
        return $this->morphOne(HrApprovalRequest::class, 'approvable');
    }

    public function getStatusAttribute(){

   return $approve_request=$this->approve_request->status;


}
}
