<?php

namespace App\Http\Controllers;

use App\HrTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrTaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes=HrTax::all();
        return view('hr.taxes.index')->with(compact('taxes'));
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
        $tax = new HrTax();
        if ($tax->validate($data)) {

            $tax->name=$request->name;
            $tax->percentage=$request->percentage;
            $tax->start=$request->start;
            $tax->end=$request->end;
            $tax->discount=$request->discount;
            $tax->restaurant_id=Auth::user()->restaurant->id;
            $tax->save();

//            \Session::flash('flash_message', 'Data successfully added!');
            return redirect()->back();
        } else {
            $errors = $tax->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
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
        $tax =  HrTax::find($id);
        if ($tax->validate($data)) {

            $tax->name=$request->name;
            $tax->percentage=$request->percentage;
            $tax->start=$request->start;
            $tax->end=$request->end;
            $tax->discount=$request->discount;
            $tax->save();
       return redirect()->back();
        } else {
            $errors = $tax->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
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
        HrTax::destroy($id);
        return redirect()->back();

    }
}
