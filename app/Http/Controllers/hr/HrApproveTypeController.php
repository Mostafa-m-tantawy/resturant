<?php

namespace App\Http\Controllers;

use App\HrApprovalType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use vendor\project\StatusTest;

class HrApproveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=HrApprovalType::all();
        return view('hr.approve_type.approve_type')->with(compact('types'));
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
        $approvalType = new HrApprovalType();
        if ($approvalType->validate($data)) {

            $approvalType->name=$request->name;
            $approvalType->style=$request->style;
            $approvalType->model=$request->model;
            $approvalType->restaurant_id=Auth::user()->restaurant->id;
            $approvalType->save();

//            \Session::flash('flash_message', 'Data successfully added!');
            return redirect()->back();
        } else {
            $errors = $approvalType->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
        return redirect('approve-type');
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
        $approvalType =  HrApprovalType::find($id);
        if ($approvalType->validate($data)) {
            $approvalType->name=$request->name;
            $approvalType->style=$request->style;
            $approvalType->save();

//            \Session::flash('flash_message', 'Data successfully added!');
            return redirect()->back();
        } else {
            $errors = $approvalType->errors();
            return redirect()->back()->withInput()->withErrors($errors);
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
