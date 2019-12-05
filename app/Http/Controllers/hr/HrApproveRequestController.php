<?php

namespace App\Http\Controllers;

use App\HrApprovalRequest;
use App\HrApprove;
use App\HrApprover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrApproveRequestController extends Controller
{


    public function myRequests()
    {

        $employee = Auth::user()->employee;
        $requests = $employee->requests;

        return view('hr.approve_request.requests')
            ->with(compact('employee', 'requests'));

    }


    public function myApproves()
    {

        $employee = Auth::user()->employee;
        $approves = HrApprovalRequest::whereHas('ApproveType', function ($q) use ($employee) {
            $q->whereHas('approvers', function ($qq) use ($employee) {
                $qq->where('hr_employee_id', $employee->id);
            });
        })->get();

        return view('hr.approve_request.approves')
            ->with(compact('employee', 'approves'));

    }


    public function response(Request $request, $id)
    {

        $approveRequest = HrApprovalRequest::find($id);
        $response_able = $this->checkResponseAbility($approveRequest);

        $approver = HrApprover::where('hr_employee_id', auth()->user()->employee->id)
            ->whereHas('approveType', function ($query) use ($approveRequest) {
                $query->where('id', $approveRequest->hr_approval_type_id);
            })->first();


        if ($response_able) {
                $approve = $approver->approve->where('hr_approval_request_id', $approveRequest->id)->first();
                if ($approve) {
                    $approve->status = $request->status;
                    $approve->save();
                } else {
                    $approve = new HrApprove();
                    $approve->hr_approval_request_id = $approveRequest->id;
                    $approve->hr_approver_id = $approver->id;
                    $approve->status = $request->status;
                    $approve->save();

                }
                $status=$request->status;

            $this->approveRequestResponse($approveRequest, $status);

return redirect()->back();
//            return response()->json('Your response saved successfully', 200);

        } else {
            return redirect()->back();

//            return response()->json('You can not response for this request!.', 422);

        }
    }


    public function checkResponseAbility($approveRequest)
    {
        $response_able = true;
        $approver = HrApprover::where('hr_employee_id', auth()->user()->employee->id)
            ->whereHas('approveType', function ($query) use ($approveRequest) {
                $query->where('id', $approveRequest->hr_approval_type_id);
            })->first();

        $level = $approver->level;


        if ($approveRequest->ApproveType->style == 'override') {
            $response_able = $this->override($approveRequest, $level);
        } elseif ($approveRequest->ApproveType->style == 'aggregate') {
            $response_able = $this->aggregate($approveRequest, $level);

        } elseif ($approveRequest->ApproveType->style == 'chain') {
            $response_able = $this->chain($approveRequest, $level);

        }

        return $response_able;
    }

    /*
     * override  if you are  top approver only
     * you can approve request
     *
     */
    public function override($approveRequest, $level)
    {
        $canResponse = true;

        if ($level != 1) {
            $canResponse = false;
        }
        if ($approveRequest->name == 'Leave Request') {

            if ($approveRequest->approvable->from <= date("Y-m-d")) {
                $canResponse = false;
            }

        }
        return $canResponse;
    }

    /*
     * aggregate  if any one of approvers reject
     * you can not approve  because it is worthless
     *
     */
    public function aggregate($approveRequest, $level)
    {

        $canResponse = true;

        if ($approveRequest->name == 'Leave Request') {

            if ($approveRequest->approvable->from <= date("Y-m-d")) {
                $canResponse = false;

            }
        }
        $approvers = HrApprover::where('hr_approval_type_id', $approveRequest->hr_approval_type_id)
            ->where('hr_employee_id', '<>', Auth::user()->employee->id)
            ->whereHas('approve', function ($q) {
                $q->where('status', 'rejected');
            })->get();

        if ($approvers->count() != 0) {
            $canResponse = false;
        }
        return $canResponse;

    }


    public function chain($approveRequest, $level)
    {
        $canResponse = true;
        if ($approveRequest->name == 'Leave Request') {

            if ($approveRequest->approvable->from <= date("Y-m-d")) {
                $canResponse = false;
            }

        }
        $applicant = HrApprover::where('hr_approval_type_id', $approveRequest->hr_approval_type_id)
            ->where('hr_employee_id', $approveRequest->hr_employee_id)->first();


        $lowerApprovers = HrApprover::where('hr_approval_type_id', $approveRequest->hr_approval_type_id);

        if ($applicant) {
            $lowerApprovers = $lowerApprovers->where('level', '<', $applicant->level);
             }


        $lowerApprovers = $lowerApprovers->where('level', '>', $level);


        $lowerNotResponse = $lowerApprovers->whereDoesnthave('approve', function ($q) use ($approveRequest) {
            $q->where('hr_approval_request_id', $approveRequest->id)->where('status', 'accepted');
        })->get();

        if ($lowerNotResponse->count() > 0) {
            $canResponse = false;
        }







        $applicant = HrApprover::where('hr_approval_type_id', $approveRequest->hr_approval_type_id)
            ->where('hr_employee_id', $approveRequest->hr_employee_id)->first();


        $higherApprovers = HrApprover::where('hr_approval_type_id', $approveRequest->hr_approval_type_id);

        if ($applicant) {
            $higherApprovers = $higherApprovers->where('level', '<', $applicant->level);
        }
        $higherApprovers = $lowerApprovers->where('level', '<', $level);

        $higherApprovers = $higherApprovers->whereHas('approve', function ($q) use ($approveRequest) {
            $q->where('hr_approval_request_id', $approveRequest->id);
        })->get();

        if ($higherApprovers->count() > 0) {
            $canResponse = false;
        }
        return $canResponse;

    }

    public function approveRequestResponse($approveRequest, $status)
    {
        if ($approveRequest->ApproveType->style == 'override') {
            $approveRequest->status = $status;
            $approveRequest->save();

        } elseif ($approveRequest->ApproveType->style == 'aggregate') {

            $approvers = HrApprover::
            where('hr_approval_type_id', $approveRequest->hr_approval_type_id)
                ->whereDoesnthave('approve', function ($q) use ($approveRequest) {
                    $q->where('hr_approval_request_id', $approveRequest->id);
                });
            if (!$approvers->count() > 0) {
                $approvers = $approvers->whereDoesnthave('approve', function ($q) use ($approveRequest) {
                    $q->where('status', 'accepted');
                });
                if ($approvers->count() > 0) {

                    $approveRequest->status = 'rejected';
                    $approveRequest->save();

                } else{
                    $approveRequest->status = 'accepted';
                    $approveRequest->save();

                }

            }
        } elseif ($approveRequest->ApproveType->style == 'chain') {

                $approvers = HrApprover::
                where('hr_approval_type_id', $approveRequest->hr_approval_type_id)->where('level', '1')
                    ->wherehas('approve', function ($q) use ($approveRequest) {
                        $q->where('hr_approval_request_id', $approveRequest->id)->where('status', 'accepted');;
                    })->get();
                if ($approvers->count() > 0) {
                    $approveRequest->status = 'accepted';
                    $approveRequest->save();

                } else {
                    $approvers = HrApprover::

                    where('hr_approval_type_id', $approveRequest->hr_approval_type_id)
                        ->whereHas('approve', function ($q) use ($approveRequest) {
                            $q->where('hr_approval_request_id', $approveRequest->id)->where('status', 'rejected');;
                        });

                      if ($approvers->get()->count() > 0) {
                            $approveRequest->status = 'rejected';
                            $approveRequest->save();

                        }
                }
            }

        }




}
