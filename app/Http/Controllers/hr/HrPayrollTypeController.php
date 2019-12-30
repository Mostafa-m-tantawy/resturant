<?php

namespace App\Http\Controllers;

use App\HrPayrollType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrPayrollTypeController extends Controller
{
    public function __construct()
{
    $this->middleware(['permission:index payroll type'],['only'=>['index']]);
    $this->middleware(['permission:create payroll type'],['only'=>['create','store']]);
    $this->middleware(['permission:update payroll type'],['only'=>['edit','update']]);
//    $this->middleware(['permission:delete unit'],['only'=>['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=HrPayrollType::all();
        return  view('hr.payroll.payroll_type')->with(compact('types'));
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
        $type=new HrPayrollType();

        if ($type->validate($data)) {

            $type->restaurant_id=Auth::user()->restaurant->id;
            $type->name=$request->name;
            $type->save();
        }
        else{
            $errors = $type->errors();
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
        $type= HrPayrollType::find($id);

        if ($type->validate($data)) {

            $type->name=$request->name;
            $type->save();
        }
        else{
            $errors = $type->errors();
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
