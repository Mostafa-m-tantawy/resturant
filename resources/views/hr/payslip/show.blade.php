@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('title')
    {{trans('main.show payslip')}}
@stop



@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">


        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="row">
                <div class="col-xl-4">


                    <!--Begin:: Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{trans('main.employee')}}
                                </h3>
                            </div>

                        </div>

                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.id')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$payslip->id}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.payroll')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$payslip->payroll->type->name}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.from')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$payslip->payroll->from}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.to')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$payslip->payroll->to}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.basic_salary')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$payslip->employee->salary}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.total_earning')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$earnings->sum('amount')}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.total_deduction')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$deductions->sum('amount')}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.insurance')}}:</label>
                                    <div class="col-7">

                                        <span
                                            class="form-control-plaintext kt-font-bolder">
                                            {{$payslip->insurance}} </span>
                                    </div>
                                </div>


                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.taxes')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">
                                              {{$payslip->taxes}}

                                            </span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.net_salary')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$payslip->net_salary}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.status')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$payslip->status}}</span>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                    <!--End:: Portlet-->

                </div>


                <div class="col-xl-8">

                    <!--Begin:: Portlet-->
                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                                    role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#update_tab"
                                           role="tab">
                                            <i class="flaticon2-calendar-3"></i> {{trans('main.update')}}
                                        </a>
                                    </li><li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#attendance_tab"
                                           role="tab">
                                            <i class="flaticon2-calendar-3"></i> {{trans('main.attendance')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#leaves_tab"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> {{trans('main.leaves')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#holidays_tab"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> {{trans('main.holidays')}}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#earnings_tab"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> {{trans('main.earnings')}}
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#deductions_tab"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> {{trans('main.deductions')}}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content kt-margin-t-20">

                                <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane active" id="update_tab" role="tabpanel">
                                        <div class="kt-portlet__head">
                                            <h3>{{trans('main.update')}}</h3>
                                        </div>
                                    <form action="{{route('payslip.update',[$payslip->id])}}" method="post">
                                    <div class="kt-portlet__body">
                                            <div class="row">
                                                    @csrf
                                                    @method('put')

                                                    <div class="form-group col-12">
                                                        <label>{{trans('main.insurance')}}</label>
                                                        <input min="0" step="0.01" name="insurance" type="number" value="{{$payslip->insurance}}" class="form-control">

                                                    </div>
   <div class="form-group col-12">
                                                        <label>{{trans('main.taxes')}}</label>
                                                        <input min="0" step="0.01" name="taxes" type="number"   value="{{$payslip->taxes}}" class="form-control">
       <a href="#" title="calculate taxes"
          data-toggle="modal" data-target="#calculatetaxes">{{trans('main.calculate_hear')}} </a>
                                                    </div>
   <div class="form-group col-12">
                                                        <label>{{trans('main.leave')}}</label>
                                                        <input min="0" step="0.01" name="leave" type="number"  value="{{$payslip->leave}}"  class="form-control">

                                                    </div>
   <div class="form-group col-12">
                                                        <label>{{trans('main.holiday')}}</label>
                                                        <input min="0" step="0.01" name="holiday" type="number"  value="{{$payslip->holiday}}"  class="form-control">

                                                    </div>
                                                <div class="form-group col-12">
                                                        <input type="submit" class="btn btn-primary" value="{{trans('main.submit')}}">

                                                    </div>


                                            </div>
                                        </div>
                                       </form>
                                </div>
                                <div class="tab-pane " id="attendance_tab" role="tabpanel">
                                        <div class="kt-portlet__head">
                                            <h3>{{trans('main.attendance')}}</h3>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="datatable-responsive"
                                                           class="display table table-striped table-bordered " cellspacing="0"
                                                           style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>{{trans('main.id')}}</th>
                                                            <th>{{trans('main.employee')}}</th>
                                                            <th>{{trans('main.date')}}</th>
                                                            <th>{{trans('main.check in')}} </th>
                                                            <th>{{trans('main.check out')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($attendances as $attendance)
                                                            <tr>
                                                                <td>{{$attendance->id}}</td>
                                                                <td>{{$attendance->employee->name}}</td>
                                                                <td>{{$attendance->attendance_date}}</td>
                                                                <td>{{$attendance->check_in}}</td>
                                                                <td>{{$attendance->check_out}}</td>


                                                                {{----}}
                                                            </tr>
                                                        @endforeach


                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                       </form>
                                </div>

                                <!--End:: Tab Content-->

    <!--Begin:: Tab Content-->
                                <div class="tab-pane " id="leaves_tab" role="tabpanel">
                                        <div class="kt-portlet__head">
                                            <h3>{{trans('main.leaves')}}</h3>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="datatable-responsive"
                                                           class="display table table-striped table-bordered " cellspacing="0"
                                                           style="width:100%">

                                                        <thead>
                                                        <tr>

                                                            <th> {{trans('main.id')}}</th>
                                                            <th>{{trans('main.type')}}</th>
                                                            <th>{{trans('main.from')}}</th>
                                                            <th>{{trans('main.to')}}</th>
                                                            <th>{{trans('main.reason')}}</th>
                                                            <th>{{trans('main.status')}}</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($leaves as $leave)
                                                            <tr>
                                                                <td>{{$leave->id}}</td>
                                                                <td>{{$leave->type->name}}</td>
                                                                <td>{{$leave->from}}</td>
                                                                <td>{{$leave->to}}</td>
                                                                <td>{{$leave->reason}}</td>
                                                                <td>{{$leave->status}}</td>
                                                                     </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                       </form>
                                </div>

                                <!--End:: Tab Content-->

    <!--Begin:: Tab Content-->
                                <div class="tab-pane " id="holidays_tab" role="tabpanel">
                                        <div class="kt-portlet__head">
                                            <h3>{{trans('main.holidays')}}</h3>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table id="datatable-responsive"
                                                           class="display table table-striped table-bordered " cellspacing="0"
                                                           style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>{{trans('main.id')}}</th>
                                                            <th>{{trans('main.name')}}</th>
                                                            <th>{{trans('main.from')}} </th>
                                                            <th>{{trans('main.to')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($holidays as $holiday)
                                                            <tr>
                                                                <td>{{$holiday->id}}</td>
                                                                <td>{{$holiday->name}}</td>
                                                                <td>{{$holiday->from}}</td>
                                                                <td>{{$holiday->to}}</td>


                                                                {{----}}
                                                            </tr>
                                                        @endforeach


                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                       </form>
                                </div>

                                <!--End:: Tab Content-->

    <!--Begin:: Tab Content-->
                                <div class="tab-pane " id="earnings_tab" role="tabpanel">
                                        <div class="kt-portlet__head">
                                            <h3>{{trans('main.earnings')}}</h3>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-12">
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
                                                       </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($earnings as $detail)
                                                            <tr>
                                                                <td>{{$detail->id}}</td>
                                                                <td>{{$detail->type->name}}</td>
                                                                <td>{{trans('main.'.$detail->type->type)}}</td>
                                                                <td>{{$detail->payslip->payroll->id.'-: '.$detail->payslip->payroll->from.' -> '.$detail->payslip->payroll->to}}</td>
                                                                <td>{{$detail->hr_payslip_id}}</td>
                                                                <td>{{$detail->payslip->employee->name}}</td>
                                                                <td>{{$detail->amount}}</td>
                                                                <td>{{$detail->reason}}</td>


                                                                {{----}}
                                                            </tr>
                                                        @endforeach


                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                       </form>
                                </div>

                                <!--End:: Tab Content-->

    <!--Begin:: Tab Content-->
                                <div class="tab-pane " id="deductions_tab" role="tabpanel">
                                        <div class="kt-portlet__head">
                                            <h3>{{trans('main.deductions')}}</h3>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-12">
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
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($deductions as $detail)
                                                            <tr>
                                                                <td>{{$detail->id}}</td>
                                                                <td>{{$detail->type->name}}</td>
                                                                <td>{{trans('main.'.$detail->type->type)}}</td>
                                                                <td>{{$detail->payslip->payroll->id.'-: '.$detail->payslip->payroll->from.' -> '.$detail->payslip->payroll->to}}</td>
                                                                <td>{{$detail->hr_payslip_id}}</td>
                                                                <td>{{$detail->payslip->employee->name}}</td>
                                                                <td>{{$detail->amount}}</td>
                                                                <td>{{$detail->reason}}</td>


                                                                {{----}}
                                                            </tr>
                                                        @endforeach


                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                       </form>
                                </div>

                                <!--End:: Tab Content-->


                            </div>


                        </div>
                    </div>
                </div>

                <!--End:: Portlet-->
            </div>


        </div>
    </div>




    <div class="modal fade calculatetaxes" id="calculatetaxes" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.calculate taxes')}} <span
                                class="model_type"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-1"></div>

                            <div class="col-10">

                                <div class="form-group">
                                    <label>{{trans('main.calculate taxes')}}</label>
                                    <input type="text" class="form-control"     onchange="changetaxes(this)" name="calculate_taxes">
                                </div>
                                <div class="form-group">
                                    <label>    {{trans('main.Taxes in months')}}</label>
                                    <h4> <span id="result"></span></h4>  </div>
                                <h4>


                                </h4>
                            </div>

                            <div class="col-1"></div>


                        </div>


                    </div>


            </div>
        </div>
    </div>


@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>

    <script>
function changetaxes(input){

    var formdata = new FormData();
    formdata.append("number", $(input).val());

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/hr/change-taxes',
        type: "post",
        data: formdata,
        processData: false,
        contentType: false,
        success: function (data) {
            // console.log(data);
        $('#result').html(data);
        },
        error: function (data) {
            if (data['status'] == 422) {
                // console.log(data);
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Some thing went wrong',
                })
            }

        },
    });
}


        $.fn.dataTableExt.ofnSearch['html-input'] = function (value) {
            return $(value).val();
        };


        $(document).ready(function () {


        })
    </script>

@stop
