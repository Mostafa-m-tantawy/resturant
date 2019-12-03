<?php

namespace App\Http\Controllers;

use App\HrApprovalType;
use App\HrAttendance;
use App\HrEDDetails;
use App\HrEmployee;
use App\HrHoliday;
use App\HrLeave;
use App\HrPayroll;
use App\HrPayslip;
use App\HrTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrPayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payroll = HrPayroll::find($request->id);
        $payslips = $payroll->payslips;
        $employees = HrEmployee::all();
        return view('hr.payslip.payslip')->with(['hr_payroll_id' => $request->id])
            ->with(compact('payslips', 'employees'));

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
        $payslip = new HrPayslip();

        if ($payslip->validate($data)) {
            $approval_types = HrApprovalType::all();

            $approval_type_id = 0;
            foreach ($approval_types as $approval_type) {
                if (get_class($payslip) == $approval_type->model) {
                    $approval_type_id = $approval_type->id;
                }
            }
            if ($approval_type_id > 0) {


                $employee = HrEmployee::find($request->employee);


                $payslip->restaurant_id = Auth::user()->restaurant->id;
                $payslip->hr_payroll_id = $request->hr_payroll_id;
                $payslip->hr_employee_id = $request->employee;
                $payslip->save();


                $payslip->approve_request()->create([
                    'name' => "Payslip Request",
                    'restaurant_id' => auth()->user()->restaurant->id,
                    'hr_employee_id' => auth()->user()->employee->id,
                    'hr_approval_type_id' => $approval_type_id,
                    'subject' => "payslip " . $employee->name,
                    'details' => "Payslip",
                ]);


                return redirect()->back();
            } else {
                $errors = " Approve type not found";
                return redirect()->back()->withInput()->withErrors($errors);
            }

        } else {
            $errors = $payslip->errors();
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
        $payslip = HrPayslip::find($id);
        $payroll = HrPayroll::where('id', $payslip->hr_payroll_id)->first();

        $attendances = HrAttendance::where('hr_employee_id', $payslip->hr_employee_id)
            ->whereBetween('attendance_date', [$payroll->from, $payroll->to])
            ->where('check_out', '<>', null)->get();
        $earnings = HrEDDetails::whereBetween('created_at', [$payroll->from, $payroll->to])
            ->where('hr_payslip_id', $payslip->id)
            ->whereHas('header', function ($q) {
                $q->where('type', 'earning');
            })->get();
        $deductions = HrEDDetails::whereBetween('created_at', [$payroll->from, $payroll->to])
            ->where('hr_payslip_id', $payslip->id)
            ->whereHas('header', function ($q) {
                $q->where('type', 'deduction');
            })->get();
        $leaves = HrLeave::where('hr_employee_id', $payslip->hr_employee_id)
            ->whereHas('approve_request', function ($q) {
                $q->where('status', 'accepted');
            })->whereBetween('from', [$payroll->from, $payroll->to])
            ->orWhereBetween('to', [$payroll->from, $payroll->to])->get();
        $holidays = HrHoliday::whereBetween('from', [$payroll->from, $payroll->to])
            ->orWhereBetween('to', [$payroll->from, $payroll->to])->get();

        $insurances=$this->insurance($payslip,$payroll);
        $total_deductions=0;
        foreach($insurances as $insurance)
        {
            $total_deductions +=$insurance;
        }
        return view('hr.payslip.show')->with(compact('payslip',
            'payroll', 'attendances', 'earnings',
            'deductions', 'leaves', 'holidays','insurances','total_deductions'));

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
        $payslip =  HrPayslip::find($id);


                $payslip->insurance = $request->insurance;
                $payslip->taxes = $request->taxes;
                $payslip->leave = $request->leave;
                $payslip->holiday = $request->holiday;
                $payslip->save();
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
        HrPayslip::destroy($id);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function insurance($payslip,$payroll){

        $basic_employer     =   0;
        $basic_employee     =   0;
        $dynamic_employer   =   0;
        $dynamic_employee   =   0;

        $employee=$payslip->employee;

        $earnings = HrEDDetails::whereBetween('created_at', [$payroll->from, $payroll->to])
            ->where('hr_payslip_id', $payslip->id)
            ->whereHas('header', function ($q) {
                $q->where('type', 'earning')->where('insurance','1');
            })->get();



        $basic_employer     =   $employee->salary *(0.26);
        $basic_employee     =   $employee->salary *(0.14);
        $dynamic            =   $earnings->sum('amount') ;
        $dynamic_employee   =    $dynamic *(0.11);;
        $dynamic_employer   =    $dynamic *(0.24);;

return compact('basic_employee','basic_employer','dynamic_employee','dynamic_employer');
    }
     /**
      * Remove the specified resource from storage.
      *
      * @param int $id
      * @return \Illuminate\Http\Response
      */ public function calculateTaxes(Request $request)
    {$number=$request->number;
        $levels = HrTax::all();
        $free = 7000;
        $number = $number - $free;
        $taxes = [];
        foreach ($levels as $i => $level) {
            $end = $level->end;
            if (($i - 1) >= 0) {
                $end = $end - $levels[$i - 1]->end;
            }

            if ($number > $end) {

                $number = $number - $end;
                $taxes[] = $end * ($level->percentage / 100);


            } else {
               $final = $number * ($level->percentage / 100);
                $taxes[] =   $final - ( ($number * ($level->percentage / 100))*($level->discount/ 100));
                break;
            }

        }
        $final=0;
        foreach ($taxes as $tax){
            $final +=$tax;
        }

        return response()->json($final,'200');
    }
}
