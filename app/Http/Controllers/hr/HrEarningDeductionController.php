<?php

namespace App\Http\Controllers;

use App\HrEarningDeduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrEarningDeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=HrEarningDeduction::all();
        return view('hr.ear_de.earning_deduction')->with(compact('types'));
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

        $data=$request->all();
        $earning=new HrEarningDeduction();

        if ($earning->validate($data)) {

            $earning->restaurant_id=Auth::user()->restaurant->id;
            $earning->name=$request->name;
            $earning->type=$request->type;
            if($request->insurance=='on')
                $earning->insurance=1;
            else
                    $earning->insurance=0;
            $earning->save();
        }
        else{
            $errors = $earning->errors();
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
        $data=$request->all();
        $earning= HrEarningDeduction::find($id);
        if ($earning->validate($data)) {

            $earning->name=$request->name;
            if($request->insurance=='on')
                $earning->insurance=1;
            else
                $earning->insurance=0;
            $earning->save();
        }
        else{
            $errors = $earning->errors();
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
        //
    }
}
