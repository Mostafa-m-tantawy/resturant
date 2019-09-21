<?php

namespace App\Http\Controllers;

use App\Order;
use App\Safe_transfer;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CashierController extends Controller
{
    //
    public function transfer(Request $request)
    {

        return view('user.cashier.transfer');
    }

    //get all requests have been sent from me
    public function getRequests()
    {

        $requests = Auth::user()->requests;
        return view('user.cashier.requests')->with(compact('requests'));
    }

    ///get all requests have been sent to me
    public function getReceives()
    {

        $receives = Auth::user()->receives;
        return view('user.cashier.receives')->with(compact('receives'));
    }

// make request but no transfer money
// all transfers done when the request approved
    public function transferRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);
        $validator->after(function ($validator)use($request) {
            $old_request= Safe_transfer::where('sender_id',Auth::user()->id)->where('is_approved',0)->get();
            if($old_request->count()>0){
                $validator->errors()->add('transfer', 'Request is pending !');
            }
            if(Auth::user()->balance<$request->amount){
                $validator->errors()->add('checkbalance', 'Not Enough Balance !');
            }
        });
        if ($validator->fails()) {
            return view('user.cashier.transfer')
                ->withErrors($validator);
        }


        $last_order = Order::where('cashier', Auth::user()->id)->orderBy('created_at', 'DESC')->first();

        $cashir_request = new Safe_transfer();
        $cashir_request->sender_id = Auth::user()->id;
        $cashir_request->receiver_id = $request->receiver_id;
        $cashir_request->amount = $request->amount;
        $cashir_request->note = $request->note;

        if (Auth::user()->balance)
            $cashir_request->percentage = ($request->amount / Auth::user()->balance) * 100;
        if ($last_order)
            $cashir_request->last_order_id = $last_order->id;
        $cashir_request->save();

        return redirect('transfer');
    }

// all transfer done here
// sum all orders from last approved transfer
//adding to balance
//subtract amount of money from balance
    public function activateRequest($id)
    {

//      dd(  $this->currentOrderBalance(Auth::user()->id));
        $request = Safe_transfer::find($id);
        $request->is_approved = 1;

        $total_balance = 0;

        //get last approved transfer
        $last_transfer = Safe_transfer::where('created_at','<',$request->created_at)
            ->where('sender_id', $request->sender_id)
            ->orderBy('created_at', 'DESC')
            ->first();



        //get orders from start order to last order
        $orders = Order::where('cashier', $request->sender_id);
        if ($last_transfer) {
            $start_order = Order::find($last_transfer->last_order_id);
            if ($start_order)
                $orders = $orders->where('created_at', '>', $start_order->created_at);

        }

        if ($request->last_order_id) {
            $last_order = Order::find($request->last_order_id);
            if($last_order)
                $orders = $orders->where('created_at', '<=', $last_order->created_at);
        }
        $orders = $orders->get();

        foreach ($orders as $order) {
            $total_balance += $order->totalPlusPlus;
        }
            $sender = $request->sender;
            $sender->balance = $total_balance + $sender->balance - $request->amount;
            if ($sender->balance) {
                $request->percentage = ($request->amount / $sender->balance) * 100;
            }

            $sender->save();

            $receiver = $request->receiver;
            $receiver->balance = $receiver->balance + $request->amount;
            $receiver->balance_date = Carbon::now();

            $receiver->save();

        $request->save() ;


        return redirect('transfer');
    }



    public function cancelRequest($id)
    {
   Safe_transfer::destroy($id);
        return redirect()->back();

    }

    public function currentBalance()
    {
    $users=User::all();
        $total_balance=0;
        foreach ($users as $user){
            $total_balance+=  $user->totalbalance;
        }
    return $total_balance;
    }
}
