<?php

namespace App\Http\Controllers;

use App\HrApprovalType;
use App\HrEmployee;
use App\HrLeave;
use App\HrLeaveType;
use Illuminate\Http\Request;

class HrLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves=HrLeave::all();
        return view('hr.leave.index')->with(compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=HrLeaveType::all();
        return view('hr.leave.create')->with(compact('types'));
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
        $leave = new HrLeave();
        if ($leave->validate($data))
        {
            $approval_types = HrApprovalType::all();

            $approval_type_id = 0;
            foreach ($approval_types as $approval_type){
                if(get_class($leave) == $approval_type->model){
                    $approval_type_id = $approval_type->id;
                }
            }
            if($approval_type_id > 0){
                $leave->hr_employee_id     = auth()->user()->employee->id;
                    $leave->restaurant_id     = auth()->user()->restaurant->id;
                    $leave->hr_leave_type_id     = $request->get('type');
                    $leave->from        = $request->get('from');
                    $leave->to          = $request->get('to');
                    $leave->reason      = $request->get('reason');
                    $leave->save();

                $leave->approve_request()->create([
                    'name'              => "Leave Request",
                    'restaurant_id'              => auth()->user()->restaurant->id,
                    'hr_employee_id'       => auth()->user()->employee->id,
                    'hr_approval_type_id'  => $approval_type_id,
                    'subject'           => $leave->type->name,
                    'details'           => $leave->reason,
                ]);

                return redirect()->back();
            }
            else
            {
                $errors = " Approve type not found";
                return redirect()->back()->withInput()->withErrors($errors);
            }

        }
        else
        {
            $errors = $leave->errors();
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
    }
}
