<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons=Coupon::all();
        return view('conf.coupon.index')->with(compact('coupons'));
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
        $coupon = new Coupon();
        if ($coupon->validate($data)) {
            $coupon->restaurant_id      =auth::user()->restaurant->id;
            $coupon->name      = $request->name;
            $coupon->description      = $request->description;
            $coupon->from      = $request->from;
            $coupon->to      = $request->to;
            $coupon->percentage      = $request->percentage;
            $coupon->save();

            return  redirect()->back();
        } else {
            $errors = $coupon->errors();
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
        $data = $request->all();
        $coupon =  Coupon::find($id);
        if ($coupon->validate($data)) {
            $coupon->restaurant_id      =auth::user()->restaurant->id;
            $coupon->name      = $request->name;
            $coupon->description      = $request->description;
            $coupon->from      = $request->from;
            $coupon->to      = $request->to;
            $coupon->percentage      = $request->percentage;
            $coupon->save();

            return  redirect()->back();
        } else {
            $errors = $coupon->errors();
            return  redirect()->back()->withInput()->withErrors($errors);
        }
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
