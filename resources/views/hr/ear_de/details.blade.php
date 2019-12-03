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
                        {{trans('main.earnings and deductions')}}
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
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.type')}} </th>
                        <th>{{trans('main.payroll')}} </th>
                        <th>{{trans('main.payslip')}} </th>
                        <th>{{trans('main.employee')}} </th>
                        <th>{{trans('main.amount')}} </th>
                        <th>{{trans('main.reason')}} </th>
                        <th>{{trans('main.update')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{$detail->id}}</td>
                            <td>{{$detail->type->name}}</td>
                            <td>{{trans('main.'.$detail->type->type)}}</td>
                            <td>{{$detail->payslip->payroll->id.'-: '.$detail->payslip->payroll->from.' -> '.$detail->payslip->payroll->to}}</td>
                            <td>{{$detail->hr_payslip_id}}</td>
                            <td>{{$detail->payslip->employee->name}}</td>
                            <td>{{$detail->amount}}</td>
                            <td>{{$detail->reason}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updateAsset"
                                   data-amount="{{$detail->amount}}" data-id="{{$detail->id}}"
                                   data-reason="{{$detail->reason}}"data-type="{{$detail->hr_earning_deduction_id}}"
                                   data-payroll="{{$detail->payslip->payroll->id}}"data-employee="{{$detail->payslip->employee->id}}">
                                    <i class="flaticon-edit"></i>
                                </a>
                            </td>

                            {{----}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="modal fade updateAsset" id="updateAsset" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.earnings and deductions')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="container">
                            <div class="row">
                                <div class=" form-group col-12">
                                    <label>{{trans('main.id')}}</label>
                                    <input type="number" readonly class="form-control" name="id">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{trans('main.type')}}</label>
                                    <select  name="type" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.type')}}</option>

                                       @foreach($types as $type)

                                            <option  value="{{$type->id}}"> {{$type->name}}</option>

                                           @endforeach
                                          </select>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.payroll')}}</label>
                                    <select  readonly name="payroll" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.payroll')}}</option>

                                       @foreach($payrolls as $payroll)

                                            <option  value="{{$payroll->id}}"> {{$payroll->id.'-: '.$payroll->from.' -> '.$payroll->to}}</option>

                                           @endforeach
                                          </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{trans('main.employees')}}</label>
                                    <select readonly  name="employee" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.employee')}}</option>

                                       @foreach($employees as $employee)

                                            <option  value="{{$employee->id}}"> {{$employee->name}}</option>

                                           @endforeach
                                          </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{trans('main.amount')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="amount">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{trans('main.reason')}}</label>
                                    <input type="text" class="form-control" name="reason">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit"
                                    class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.submit')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade newLeaveType" id="newLeaveType" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('earning-details.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.earnings and deductions')}} <span
                                class="model_type"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-1"></div>

                            <div class="col-10">

                                <div class="form-group ">
                                    <label>{{trans('main.type')}}</label>
                                    <select  name="type" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.type')}}</option>

                                        @foreach($types as $type)

                                            <option  value="{{$type->id}}"> {{$type->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label>{{trans('main.payrolls')}}</label>
                                    <select  name="payroll" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.payroll')}}</option>

                                        @foreach($payrolls as $payroll)

                                            <option  value="{{$payroll->id}}"> {{$payroll->id.'-: '.$payroll->from.' -> '.$payroll->to}}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label>{{trans('main.employees')}}</label>
                                    <select  name="employee" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.employee')}}</option>

                                        @foreach($employees as $employee)

                                            <option  value="{{$employee->id}}"> {{$employee->name}}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.amount')}}</label>
                                    <input type="number" min="0" step="0.01" class="form-control" name="amount">
                                </div>

                                <div class="form-group ">
                                    <label>{{trans('main.reason')}}</label>
                                    <input type="text" class="form-control" name="reason">
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
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    {{----}}
    <script>

        $(document).ready(function () {
//
            $('#updateAsset').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var amount = $(e.relatedTarget).data('amount');
                var employee = $(e.relatedTarget).data('employee');
                var payroll = $(e.relatedTarget).data('payroll');
                var reason = $(e.relatedTarget).data('reason');
                var type = $(e.relatedTarget).data('type');

                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="amount"]').val(amount);
                $(e.currentTarget).find('input[name="reason"]').val(reason);
                $(e.currentTarget).find('select[name="employee"]').val(employee);
                $(e.currentTarget).find('select[name="payroll"]').val(payroll);
                $(e.currentTarget).find('select[name="type"]').val(type);
                $(e.currentTarget).find('form').attr('action', "{{url('hr/earning-details/')}}/" + Id);
            });


        })
    </script>

@stop
