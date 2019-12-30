<?php

namespace App\Http\Controllers;

use App\HrShift;
use App\HrShiftHour;
use Illuminate\Http\Request;

class HrShiftHoursController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:index shift hour'],['only'=>['index']]);
        $this->middleware(['permission:create shift hour'],['only'=>['create','store']]);
        $this->middleware(['permission:update shift hour'],['only'=>['edit','update']]);
//    $this->middleware(['permission:delete unit'],['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shift=HrShift::find($request->id);
        $hours=$shift->hours;
        return view('hr.shifts.shifts_hours')->with(compact('shift','hours'));
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
        $shiftHour = new HrShiftHour();

        if ($shiftHour->validate($data))
        {
            $shiftHour->restaurant_id     = auth()->user()->restaurant->id;
            $shiftHour->hr_shift_id     = $request->get('shift_id');
            $shiftHour->start_day     = $request->get('start_day');
            $shiftHour->end_day        = $request->get('end_day');
            $shiftHour->start_time          = $request->get('start_time');
            $shiftHour->end_time          = $request->get('end_time');
            $shiftHour->save();


            return redirect()->back();
        }
        else
        {
            $errors = $shiftHour->errors();
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
        $shiftHour =  HrShiftHour::find($id);

        if ($shiftHour->validate($data))
        {
            $shiftHour->start_day     = $request->get('start_day');
            $shiftHour->end_day        = $request->get('end_day');
            $shiftHour->start_time          = $request->get('start_time');
            $shiftHour->end_time          = $request->get('end_time');
            $shiftHour->save();


            return redirect()->back();
        }
        else
        {
            $errors = $shiftHour->errors();
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
