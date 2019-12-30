<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:print department'],['only'=>['department']]);
        $this->middleware(['permission:print client'],['only'=>['client']]);
     }


    public function client($id){
        $order=Order::find($id);

        $pdf = PDF::loadView('pos.print.order_client', ['order'=>$order]);
        return $pdf->download('invoice.pdf');
//        return view('pos.print.order_client')->with(compact('order'));

    }

    public function department($id){
        $order=Order::find($id);

        $pdf = PDF::loadView('pos.print.order_department', ['order'=>$order]);
        return $pdf->download('invoice.pdf');
//        return view('pos.print.order_client')->with(compact('order'));

    }
}
