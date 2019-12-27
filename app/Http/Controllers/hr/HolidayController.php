<?php

namespace App\Http\Controllers;

use App\HrHoliday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays=HrHoliday::all();
        return view('hr/holiday.index')->with(compact('holidays'));
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
        $holiday = new HrHoliday();

        if ($holiday->validate($data))
        {
            $holiday->restaurant_id     = auth()->user()->restaurant->id;
            $holiday->name     = $request->get('name');
            $holiday->to        = $request->get('to');
            $holiday->from          = $request->get('from');
            $holiday->save();


            return redirect()->back();
        }
        else
        {
            $errors = $holiday->errors();
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
        $holiday =  HrHoliday::find($id);

        if ($holiday->validate($data))
        {
            $holiday->name     = $request->get('name');
            $holiday->to        = $request->get('to');
            $holiday->from          = $request->get('from');
            $holiday->save();


            return redirect()->back();
        }
        else
        {
            $errors = $holiday->errors();
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
        HrHoliday::destroy($id);
        return  redirect()->back();

    }
}
