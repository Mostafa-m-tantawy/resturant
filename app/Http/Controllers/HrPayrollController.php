<?php

namespace App\Http\Controllers;

use App\HrApprovalType;
use App\HrPayroll;
use App\HrPayrollType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrPayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrolls = HrPayroll::orderByDesc('to')->get();
        $types = HrPayrollType::all();
        return view('hr.payroll.payroll')->with(compact('payrolls', 'types'));
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
    {       $data = $request->all();
        $payroll =new HrPayroll;

        if ($payroll->validate($data)) {
            $approval_types = HrApprovalType::all();

            $approval_type_id = 0;
            foreach ($approval_types as $approval_type) {
                if (get_class($payroll) == $approval_type->model) {
                    $approval_type_id = $approval_type->id;
                }
            }
            if ($approval_type_id > 0) {

                $payroll->restaurant_id = Auth::user()->restaurant->id;
                $payroll->hr_payroll_type_id = $request->type;
                $payroll->from = $request->from;
                $payroll->to = $request->to;
                $payroll->save();


                $payroll->approve_request()->create([
                    'name' => "Payroll Request",
                    'restaurant_id'              => auth()->user()->restaurant->id,
                    'hr_employee_id'       => auth()->user()->employee->id,
                    'hr_approval_type_id'  => $approval_type_id,
                    'subject' => "Payroll " . $payroll->from,
                    'details' => "Payroll " . $payroll->type->name . " " . $payroll->from . " " . $payroll->to,
                ]);


                return redirect()->back();
            } else {
                $errors = " Approve type not found";
                return redirect()->back()->withInput()->withErrors($errors);
            }

        } else {

            $errors = $payroll->errors();
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
        $payroll = HrPayroll::find($id);

        if ($payroll->validate($data)) {
            $approval_types = HrApprovalType::all();

            $approval_type_id = 0;
            foreach ($approval_types as $approval_type) {
                if (get_class($payroll) == $approval_type->model) {
                    $approval_type_id = $approval_type->id;
                }
            }
            if ($approval_type_id > 0) {

               $payroll->hr_payroll_type_id = $request->type;
                $payroll->from = $request->from;
                $payroll->to = $request->to;
                $payroll->save();

                return redirect()->back();
            } else {
                $errors = " Approve type not found";
                return redirect()->back()->withInput()->withErrors($errors);
            }

        } else {

            $errors = $payroll->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($id)
        {
            //
        }
    }
