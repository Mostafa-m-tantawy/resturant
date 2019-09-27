<?php

namespace App\Http\Controllers;

use App\Address;
use App\Country;
use App\Phone;
use App\State;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers=Supplier::all();
        return  view('frontend.supplier.index')->with(compact('suppliers'));
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
        $countries=Country::all();
        return view('frontend.supplier.create')->with(compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=new User ;
        $user->email=$request->email;
        $user->name=$request->name;
        $user->password=Hash::make($request->password);
        $user->save();

        $supplier=new Supplier();
        $supplier->start_balance	=$request->balance;
        $supplier->user_id=$user->id;
        $supplier->save();

      foreach ($request->phone_g as $item){
          $phone=new Phone();
          $phone->phone=$item['phone'];
        $phone->type=$item['type'];
        $phone->user_id=$user->id;;
        $phone->save();

      }
      foreach ($request->address_g as $item){
          if(isset($item['address'])) {
              $address = new Address();
              $address->address = $item['address'];
              if (isset($item['city']))
                  $address->city_id = $item['city'];
              $address->user_id = $user->id;;
              $address->save();
          }
      }



        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payments=[];
        $supplier=user::find(5);
        return  view('frontend.supplier.show')->with(compact('payments','supplier'));
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
        //
    } public function states(Request $request)
    {
$cities=State::where('country_id',$request->id)->get();
        return response()->json($cities,200);
        //
    }
}
