<?php

namespace App\Http\Controllers;

use App\HrEmployee;
use App\MoneyTransfer;
use App\OrderPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MoneyTransferController extends Controller
{
    //



    public function request()
    {
     $requests=MoneyTransfer::
     where('sender_id',Auth::user()->employee->id)
         ->get();
     $employees=HrEmployee::all();

     return view('cashier.request')->with(compact('requests','employees'));
    }
   public function receive()
    {
     $receives=MoneyTransfer::
     where('receiver_id',Auth::user()->employee->id)
         ->get();
        return view('cashier.receive')->with(compact('receives'));
    }




    public function storeRequest(Request $request)
    {
        $employee=Auth::user()->employee;
        $validator = Validator::make($request->all(), [
            'receiver' => 'required|Integer',
            'amount' => 'required|numeric|min:0',
        ]);
        $validator->after(function ($validator)use($employee,$request) {
            $old_request= MoneyTransfer::
            where('sender_id',$employee->id)
                ->where('status','pending')->get();

            if($old_request->count()>0){
                $validator->errors()->add('transfer', 'Request is pending !');
            }
          if($request->receiver !=$employee->id)
          {
              if($employee->balance<$request->amount){
                $validator->errors()->add('checkbalance', 'Not Enough Balance !');
            }
          }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $last_payment = OrderPayment::where('employee_id', $employee->id)->orderBy('created_at', 'DESC')->first();

        $cashier_request = new MoneyTransfer();
        $cashier_request->restaurant_id = $employee->restaurant->id;
        $cashier_request->sender_id = $employee->id;
        $cashier_request->receiver_id = $request->receiver;
        $cashier_request->amount = $request->amount;
        $cashier_request->note = $request->note;

        if ($last_payment)
            $cashier_request->payment_id = $last_payment->id;
        $cashier_request->save();

        return redirect()->back();
    }



    public function storeApprove(Request $request,$id)
    {

        $moneyRequest = MoneyTransfer::find($id);
        $moneyRequest->status = $request->status;

        $sender = $moneyRequest->sender;
        if($moneyRequest->receiver->id !=$sender->id) {
            $sender->balance = $sender->balance - $moneyRequest->amount;
            $sender->last_balance_update = Carbon::now();
            $sender->save();
        }
        $receiver = $moneyRequest->receiver;
        $receiver->balance = $receiver->balance + $moneyRequest->amount;
        $receiver->last_balance_update =  Carbon::now();

        $receiver->save();

        $moneyRequest->save() ;


        return redirect()->back();
    }



    public function cancelRequest($id)
    {

        MoneyTransfer::destroy($id);
        return redirect()->back();

    }

//    public function currentBalance()
//    {
//        $users=User::all();
//        $total_balance=0;
//        foreach ($users as $user){
//            $total_balance+=  $user->totalbalance;
//        }
//        return $total_balance;
//    }
}
