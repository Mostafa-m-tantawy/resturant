@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <!-- begin:: Content -->

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{trans('main.payslip')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="#" data-toggle="modal" data-target="#newLeaveType"
                               class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.record')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!--begin: Datatable -->
                <table id="datatable-responsive"
                       class="display table table-striped table-bordered " cellspacing="0"
                       style="width:100%">
                    <thead>


                    <tr>
                        <th>{{trans('main.id')}}</th>
                        <th>{{trans('main.payroll')}}</th>

                        <th>{{trans('main.from')}} </th>
                        <th>{{trans('main.to')}}</th>
                        <th>{{trans('main.basic_salary')}}</th>

                        <th>{{trans('main.total_earning')}}</th>
                        <th>{{trans('main.total_deduction')}}</th>

                        <th>{{trans('main.net_salary')}}</th>

                        <th>{{trans('main.created_at')}}</th>

                        <th>{{trans('main.status')}}</th>
                        <th>{{trans('main.details')}}</th>
                        <th>{{trans('main.delete')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payslips as $payslip)
                        <tr>
                            <td>{{$payslip->id}}</td>
                            <td>{{$payslip->payroll->type->name}}</td>
                            <td>{{$payslip->payroll->from}}</td>
                            <td>{{$payslip->payroll->to}}</td>
                            <td>{{$payslip->employee->salary}}</td>
                            <td>{{$payslip->total_earning}}</td>
                            <td>{{$payslip->total_deduction}}</td>
                            <td>{{$payslip->net_salary}}</td>
                            <td>{{$payslip->created_at}}</td>
                            <td>{{$payslip->status}}</td>
                            <td><a href="{{route('payslip.show',[$payslip->id])}}" >
                                    <i class="flaticon-web"></i>
                                </a></td>
                            <td>delete</td>

                             {{----}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>
 <div class="modal fade newLeaveType" id="newLeaveType" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('payslip.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new payslip')}} <span
                                class="model_type"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" readonly class="form-control" name="hr_payroll_id" value="{{$hr_payroll_id}}" >

                            <div class="col-1"></div>

                            <div class="col-10">

                                <div class="form-group col-12">
                                    <label>{{trans('main.employee')}}</label>
                                    <select name="employee" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.employee')}}</option>
                                        @foreach($employees as $employee)
                                            <option  value="{{$employee->id}}">{{$employee->name}} </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-1"></div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit"
                                    class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.create')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
@section('scripts')


@stop
