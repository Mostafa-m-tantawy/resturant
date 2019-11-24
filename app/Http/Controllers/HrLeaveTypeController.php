<?php

namespace App\Http\Controllers;

use App\HrLeave;
use App\HrLeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrLeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=HrLeaveType::all();
        return  view('hr.leave.leave_type')->with(compact('types'));
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
        $emergency=new HrLeaveType;

        if ($emergency->validate($data)) {

            $emergency->restaurant_id=Auth::user()->restaurant->id;
            $emergency->name=$request->name;
            $emergency->type=$request->type;
            $emergency->save();
        }
        else{
            $errors = $emergency->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        return redirect('leave-type');

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
        $emergency= HrLeaveType::find($id);

        if ($emergency->validate($data)) {

            $emergency->name=$request->name;
            $emergency->type=$request->type;
            $emergency->save();
        }
        else{
            $errors = $emergency->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        return redirect('leave-type');
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
