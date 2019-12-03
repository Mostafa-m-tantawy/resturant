<?php

namespace App\Http\Controllers;

use App\HrAttendance;
use App\HrEmployee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances=HrAttendance::where('check_out',null)->get();
        $employees=HrEmployee::whereDoesntHave('attendance',function ($q){
           $q->where('check_out',null);
        })->get();
        return view('hr.attendance.index')->with(compact('attendances','employees'));
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
        $attendance=new HrAttendance;
        $employee=HrEmployee::find($request->employee_id);
        $shift=$employee->shift->first();
        if($shift){
            $shifthour=$shift->lastShiftHors();
            if(!$shifthour) {
                $errors = "shift has no shift hours";
                return redirect()->back()->withErrors($errors)->withInput();
            }
        }else{
            $errors = "this employee does not assigned to shift";
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $attendance->restaurant_id      =   Auth::user()->restaurant->id;
        $attendance->hr_employee_id     =   $employee->id;
        $attendance->hr_shift_hour_id   =   $shifthour->id;
        $attendance->attendance_date    =   Carbon::now();
        $attendance->check_in           =   Carbon::now()->toTimeString();
        $attendance->save();

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
        $attendance= HrAttendance::find($id);


        $attendance->restaurant_id      =   Auth::user()->restaurant->id;
       $attendance->attendance_date    =   $request->attendance_date;
        $attendance->check_in           =   $request->check_in;
        $attendance->check_out          =   $request->check_out;;


        $attendance->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request,$id)
    {
        $attendance= HrAttendance::find($id);
        $attendance->check_out           =   Carbon::now()->toTimeString();

        $attendance->save();

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $attendances=HrAttendance::where('check_out','<>',null)->orderByDesc('updated_at')->get();

        return view('hr.attendance.history')->with(compact('attendances'));


    }
}
