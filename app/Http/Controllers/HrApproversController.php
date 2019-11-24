<?php

namespace App\Http\Controllers;

use App\HrApprovalType;
use App\HrApprover;
use App\HrEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrApproversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type=HrApprovalType::find($request->id);
        $approvers=$type->approvers;
        $employees=HrEmployee::all();
        return  view('hr.approver.approver')
            ->with(compact('type','approvers','employees'))
            ->with('hr_approval_type_id',$request->id);
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
        $approver = new HrApprover();
        if ($approver->validate($data))
        {

            $approver->restaurant_id= Auth::user()->restaurant->id;
            $approver->hr_employee_id=$request->approver;
            $approver->level=$request->level;
            $approver->hr_approval_type_id=$request->hr_approval_type_id;
            $approver->save();
            return redirect('approver?id='.$request->hr_approval_type_id);
        }
        else
        {
            $errors = $approver->errors();
            return redirect()->back()->withInput()->withErrors($errors);
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
        $approver = HrApprover::find($id);
        if ($approver->validate($data))
        {

            $approver->level=$request->level;
            $approver->save();
            return redirect('approver?id='.$request->hr_approval_type_id);

        }
        else
        {
            $errors = $approver->errors();
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
        HrApprover::destroy($id);
        return redirect()->back();
    }
}
