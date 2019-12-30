<?php

namespace App\Http\Controllers;

use App\HrEarningDeduction;
use App\HrEDDetails;
use App\HrEmployee;
use App\HrPayroll;
use App\HrPayslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrEarningDeductionDetailsController extends Controller
{ public function __construct()
{
    $this->middleware(['permission:index earning'],['only'=>['index']]);
    $this->middleware(['permission:create earning'],['only'=>['create','store']]);
    $this->middleware(['permission:update earning'],['only'=>['edit','update']]);
//    $this->middleware(['permission:delete unit'],['only'=>['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = HrEDDetails::whereHas('payslip')->get();
        $employees = HrEmployee::all();
        $payrolls = HrPayroll::all();
        $types = HrEarningDeduction::all();
        return view('hr.ear_de.details')
            ->with(compact('details', 'employees', 'payrolls', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $earning = new HrEDDetails();

        $type = HrEarningDeduction::find($request->type);


        if ($earning->validate($data)) {

            $payslip = HrPayslip::where('hr_payroll_id', $request->payroll)->where('hr_employee_id', $request->employee)->first();


            if ($type->type == 'earning') {
                $payslip->total_earning = $payslip->total_earning + $request->amount;
            } else {
                $payslip->total_deduction = $payslip->total_earning + $request->amount;
            }
            $payslip->save();

            $earning->hr_payslip_id = $payslip->id;
            $earning->hr_earning_deduction_id = $request->type;
            $earning->reason = $request->reason;
            $earning->amount = $request->amount;
            $earning->save();
        } else {
            $errors = $earning->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        return redirect()->back();
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
        $earning = HrEDDetails::find($id);
        $type = $earning->type;
        $typerequest = HrEarningDeduction::find($request->type);
        if ($earning->validate($data)) {

            $payslip = $earning->payslip;
            if ($type->type == 'earning') {
                $payslip->total_earning = $payslip->total_earning - $earning->amount;
            } else {
                $payslip->total_deduction = $payslip->total_deduction - $earning->amount;
            }
            if ($typerequest->type == 'earning') {
                $payslip->total_earning = $payslip->total_earning + $request->amount;
            } else {
                $payslip->total_deduction = $payslip->total_earning + $request->amount;
            }
            $payslip->save();

            $earning->hr_earning_deduction_id = $request->type;
            $earning->reason = $request->reason;
            $earning->amount = $request->amount;
            $earning->save();
        } else {
            $errors = $earning->errors();
            return redirect()->back()->withInput()->withErrors($errors);
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
    }
}
