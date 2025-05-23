<?php

namespace App\Http\Controllers;

use App\ClientAccount;
use App\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create client payment'],['only'=>['Store']]);
        $this->middleware(['permission:delete client payment'],['only'=>['destroy']]);
//        $this->middleware(['permission:delete dish category'],['only'=>['destroy']]);
    }


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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $payment = new ClientAccount();
        if ($payment->validate($data)) {
            $payment->client_id      = $request->client_id;
            $payment->amount     = $request->amount;
            $payment->method     = $request->payment_method;
            $payment->note = $request->note;
            $payment->save();

            return  redirect()->back();
        } else {
            $errors = $payment->errors();
            return  redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClientAccount::destroy($id);
        return redirect()->back();
    }
}
