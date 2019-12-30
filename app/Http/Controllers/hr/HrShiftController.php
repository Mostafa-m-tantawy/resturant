<?php

namespace App\Http\Controllers;

use App\HrEmployee;
use App\HrShift;
use Illuminate\Http\Request;

class HrShiftController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:index shift'],['only'=>['index']]);
        $this->middleware(['permission:create shift'],['only'=>['create','store']]);
        $this->middleware(['permission:update shift'],['only'=>['edit','update']]);
    $this->middleware(['permission:detach shift employee'],['only'=>['detachShift']]);
    $this->middleware(['permission:attach shift employee'],['only'=>['attachShift']]);
    $this->middleware(['permission:index shift employee'],['only'=>['shiftEmployees']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = HrShift::all();
        return view('hr.shifts.shifts')->with(compact('shifts'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $shift = new HrShift();

        if ($shift->validate($data)) {
            $shift->restaurant_id = auth()->user()->restaurant->id;
            $shift->type = $request->get('type');
            $shift->name = $request->get('name');
            $shift->threshold = $request->get('threshold');
            $shift->save();


            return redirect()->back();
        } else {
            $errors = $shift->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $shift = HrShift::find($id);

        if ($shift->validate($data)) {

            $shift->type = $request->get('type');
            $shift->name = $request->get('name');
            $shift->threshold = $request->get('threshold');
            $shift->save();


            return redirect()->back();
        } else {
            $errors = $shift->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function attachShift(Request $request)
    {
        $shift = HrShift::find($request->shift_id);
        $shift->employees()->attach($request->employee_id);;

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function detachShift(Request $request)
    {
        $shift = HrShift::find($request->shift_id);

        $shift->employees()->detach($request->employee_id);


        return redirect()->back();
        //
    }

    public function shiftEmployees(Request $request)
    {
        $shift = HrShift::find($request->id);
        $employees = HrEmployee::whereDoesntHave('shift')->get();

        return view('hr.shifts.shifts_employee')->with(compact('shift', 'employees'));
        //
    }
}
