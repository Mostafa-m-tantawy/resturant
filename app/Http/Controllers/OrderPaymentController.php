<?php

namespace App\Http\Controllers;

use App\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $payment = new OrderPayment();
        if ($payment->validate($data)) {
            $payment->restaurant_id = Auth::user()->restaurant->id;
            $payment->order_id      = $request->order_id;
            $payment->amount     = $request->amount;
            $payment->method     = $request->payment_method;
            if($payment->method=='account'){
                $payment->client_id     = $request->client_id;
            }
            $payment->note = $request->note;
            $payment->save();
            return response()->json('ok', '200');
        } else {
            $errors = $payment->errors();
            return response()->json($errors, '200');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderPayment::destroy($id);
        return  redirect()->back();
    }
}
