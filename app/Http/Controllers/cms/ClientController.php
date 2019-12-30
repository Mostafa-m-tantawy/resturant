<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:index client'],['only'=>['index']]);
        $this->middleware(['permission:create client'],['only'=>['create','store']]);
        $this->middleware(['permission:update client'],['only'=>['edit','update']]);
//        $this->middleware(['permission:delete dish category'],['only'=>['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Client::all();
        return  view('pos.client.index')->with(compact('clients'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'phone1' => 'required|unique:clients|max:255',
            'phone2' => 'nullable|unique:clients|max:255',
            'email' => 'nullable | string|max:255',
            'national_id' => 'nullable | string|max:255',
        ]);
        $client=new Client;
        $client->name=$request->name;
        $client->email=$request->email;
        $client->phone1=$request->phone1;
        $client->phone2=$request->phone2;
        $client->national_id=$request->national_id;
        $client->restaurant_id=Auth::user()->restaurant->id;
        $client->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client=Client::find($id);
        $payments=$client->payments;
        $orderPayments=$client->orderPayments;
        return view('pos.client.client_account')->with(compact('client','payments','orderPayments'));
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

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'phone1' => 'required|unique:clients,phone1,'.$id.'|max:255',
            'phone2' => 'nullable|unique:clients,phone2,'.$id.'|max:255',
            'email' => 'nullable | string|max:255',
            'national_id' => 'nullable | string|max:255',
        ]);
        $client= Client::find($id);
        $client->name=$request->name;
        $client->email=$request->email;
        $client->phone1=$request->phone1;
        $client->phone2=$request->phone2;
        $client->national_id=$request->national_id;
        $client->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
