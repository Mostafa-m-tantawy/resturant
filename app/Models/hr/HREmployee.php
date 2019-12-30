<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;

class HrEmployee extends Model
{
    use baseTrait,restaurantScopeTrait,HasRoles;

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

    public function shift(){
        return $this->belongsToMany(HrShift::class,'employee_shift','hr_shift_id','hr_employee_id');
    }

    public function attendance(){
        return $this->hasMany(HrAttendance::class,'hr_employee_id');
    }
    public  function  getshiftNameAttribute(){

      $shift= $this->shift->first();
        if( $shift  )
       return $shift->name;

    }


    public function getBalanceAttribute()
    {
        $balance=$this->getOriginal('balance');

        $last_transfer = MoneyTransfer::where('status',1)
            ->where('sender_id', $this->id)
            ->orderBy('created_at', 'DESC')
            ->first();

        $payments = OrderPayment::where('employee_id',$this->id)  ->whereIn('method',['cash','check']);;
        $paymentAccount=ClientAccount::where('employee_id',$this->id)  ->whereIn('method',['cash','check']);;

        if ($last_transfer) {

            $start_payment = OrderPayment::find($last_transfer->payment_id);

            if ($start_payment){

                $payments = $payments->
                    where('created_at', '>', $start_payment->created_at);


                $paymentAccount=$paymentAccount->
                where('created_at', '>', $start_payment->created_at)
                    ;
            }
        }

        return $balance + $payments->sum('amount')+$paymentAccount->sum('amount');
    }
}
