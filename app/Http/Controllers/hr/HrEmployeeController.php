<?php

namespace App\Http\Controllers;

use App\Address;
use App\Department;
use App\HrAttendance;
use App\HrEmployee;
use App\HrPayroll;
use App\Phone;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HrEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:index employee'],['only'=>['index']]);
        $this->middleware(['permission:show employee'],['only'=>['show']]);
        $this->middleware(['permission:create employee'],['only'=>['create','store']]);
        $this->middleware(['permission:update employee'],['only'=>['edit','update']]);
//    $this->middleware(['permission:delete employee'],['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = HrEmployee::all();

        return view('hr.employee.index')->with(compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('hr.employee.create')->with(compact('departments'));

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
        $employee = new HrEmployee();

        if ($employee->validate($data)) {

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


            $employee->user_id = $user->id;
//            $employee->photo        =$profileImg;
            $employee->name = $user->name;
            $employee->gender = $request->get('gender');
            $employee->civil_status = $request->get('civil_status');
            $employee->date_of_birth = $request->get('date_of_birth');
            $employee->date_of_joining = $request->get('date_of_joining');
            $employee->department_id = $request->get('department');
            $employee->salary = $request->get('salary');
            $employee->bank_account = $request->get('bank_account');
            $employee->bank_name = $request->get('bank_name');

            if (!$employee->save()) {

                Phone::where($user->id)->delete();
                Address::where($user->id)->delete();
                User::destroy($user->id);
            }
        } else {
            $errors = $employee->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        return redirect(route('employee.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = HrEmployee::find($id);
        $departments = Department::all();
        $roles=$employee->user->roles;
        $allRoles=Role::all();
        $lastPayroll=HrPayroll::whereHas('payslips',function ($q)use($employee){
           $q->where('hr_employee_id',$employee->id);
       })->whereHas('approve_request',function ($q){
           $q->where('status','accepted');
        })->orderByDesc('updated_at')->first();

        $attendances = HrAttendance::where('hr_employee_id', $employee->id)->where('check_out','<>',null);
        if($lastPayroll)
            $attendances=  $attendances ->where('attendance_date',$lastPayroll->to);

        $attendances=$attendances->get();

        return view('hr.employee.show')
            ->with(compact('employee', 'roles',
                'departments','attendances','allRoles'));
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
        $employee = HrEmployee::findOrFail($id);
        $user = $employee->user;

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_g.*.phone' => ['required'],
            'phone_g.*.type' => ['required'],
            'address_g.*.address' => ['required'],]);


        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        $employee->name = $user->name;
        $employee->gender = $request->get('gender');
        $employee->civil_status = $request->get('civil_status');
        $employee->date_of_birth = $request->get('date_of_birth');
        $employee->date_of_joining = $request->get('date_of_joining');
        $employee->department_id = $request->get('department');
        $employee->salary = $request->get('salary');
        $employee->bank_account = $request->get('bank_account');
        $employee->bank_name = $request->get('bank_name');

        $employee->save();

        if (is_array($request->phone_g))
            foreach ($request->phone_g as $item) {
                $phone = new Phone();
                $phone->phone = $item['phone'];
                $phone->type = $item['type'];
                $phone->user_id = $user->id;;
                $phone->save();

            }
        if (is_array($request->address_g))
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

        return redirect()->back();

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
    }    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function associate(Request $request,$id)
    {
        $employee=HrEmployee::find($id);
        $user=$employee->user;
        $user->assignRole($request->role);
        return redirect()->back();

        //
    }    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function dissociate(Request $request,$id)
    {

        $employee=HrEmployee::find($id);
        $user=$employee->user;
        $user->removeRole($request->role);
        return redirect()->back();
    }
}
