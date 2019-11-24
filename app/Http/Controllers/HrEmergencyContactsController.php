<?php

namespace App\Http\Controllers;

use App\HrEmergencyContact;
use App\HrEmployee;
use Illuminate\Http\Request;

class HrEmergencyContactsController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data=$request->all();
        $emergency=new HrEmergencyContact();

        if ($emergency->validate($data)) {
            $emergency->phone = $request->phone;
            $emergency->name = $request->name;
            $emergency->email = $request->email;
            $emergency->address = $request->address;
            $emergency->relationship = $request->relationship;
            $emergency->hr_employee_id	 = $request->hr_employee_id;;
            $emergency->save();


        }
        else{
        $errors = $emergency->errors();
        return redirect()->back()->withInput()->withErrors($errors);
    }

        return redirect('employee/'.$request->hr_employee_id );

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
        $emergency=HrEmergencyContact::find($id);

        if ($emergency->validate($data)) {
            $emergency->phone = $request->phone;
            $emergency->name = $request->name;
            $emergency->email = $request->email;
            $emergency->address = $request->address;
            $emergency->relationship = $request->relationship;
            $emergency->save();

        }
        else{
            $errors = $emergency->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        return redirect('employee/'.$emergency->employee->id );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HrEmergencyContact::destroy($id);
        return  redirect()->back();
    }
}
