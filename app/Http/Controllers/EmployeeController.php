<?php

namespace App\Http\Controllers;

use App\Address;
use App\Department;
use App\HREmployee;
use App\Phone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees=HREmployee::all();

        return view('hr.employee.index')->with(compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
$departments=Department::all();
        return view('hr.employee.create')->with(compact('departments'));

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
        $employee=new HREmployee();

        if ($employee->validate($data))
        {

            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make(123456);
            $user->restaurant_id = Auth::user()->restaurant->id;
            $user->save();


            if ($request->phone_g) {
                foreach ($request->phone_g as $item) {
                    $phone = new Phone();
                    $phone->phone = $item['phone'];
                    $phone->type = $item['type'];
                    $phone->user_id = $user->id;;
                    $phone->save();

                }
            }
            if ($request->address_g) {
                foreach ($request->address_g as $item) {
                    if (isset($item['address'])) {
                        $address = new Address();
                        $address->address = $item['address'];
                        if (isset($item['city']))
                            $address->city_id = $item['city'];
                        $address->user_id = $user->id;;
                        $address->save();
                    }
                }
            }


            $employee->user_id =$user->id;
//            $employee->photo        =$profileImg;
            $employee->name         =$user->name;
            $employee->gender       =$user->$request->get('gender');
            $employee->civil_status      =$user->$request->get('civil_status');
            $employee->date_of_birth      =$user->$request->get('date_of_birth');
            $employee->date_of_joining    =$user->$request->get('date_of_joining');
            $employee->department_id      =$request->get('department');
            $employee->salary              =$request->get('salary');
            $employee->bank_account      =$request->get('bank_account');
            $employee->bank_name      =$request->get('bank_name');
            ;
            if(!$employee->save()){

                Phone::where($user->id)->delete();
                Address::where($user->id)->delete();
                User::destroy($user->id);
            }
        } else
        {
            $errors = $employee->errors();
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
