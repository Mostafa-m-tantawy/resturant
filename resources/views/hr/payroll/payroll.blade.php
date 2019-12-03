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
                        {{trans('main.payroll')}}
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
                        <th>{{trans('main.type')}}</th>
                        <th>{{trans('main.from')}} </th>
                        <th>{{trans('main.to')}}</th>
                        <th>{{trans('main.update')}}</th>
                        <th>{{trans('main.payslip')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payrolls as $payroll)
                        <tr>
                            <td>{{$payroll->id}}</td>
                            <td>{{$payroll->type->name}}</td>
                            <td>{{$payroll->from}}</td>
                            <td>{{$payroll->to}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".updateAsset"
                                   data-type="{{$payroll->hr_payroll_type_id}}" data-id="{{$payroll->id}}"
                                   data-from="{{$payroll->from}}" data-to="{{$payroll->to}}">
                                    <i class="flaticon-edit"></i>
                                </a>
                            </td>
                            <td><a href="{{url('hr/payslip?id='.$payroll->id)}}">  <i class="flaticon-map"></i> </a></td>

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
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.asset')}}</h5>
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
                                    <select name="type" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.type')}}</option>
                                        @foreach($types as $type)
                                        <option  value="{{$type->id}}">{{$type->name}} </option>
                                        @endforeach
                                    </select>
                                </div>


                                 <div class="form-group col-12">
                                    <label>{{trans('main.from')}}</label>
                                    <input type="date" class="form-control" name="from">
                                </div>
                                 <div class="form-group col-12">
                                    <label>{{trans('main.to')}}</label>
                                    <input type="date" class="form-control" name="to">
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
                <form action="{{route('payroll.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new asset')}} <span
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

                                <div class="form-group col-12">
                                    <label>{{trans('main.type')}}</label>
                                    <select name="type" class="form-control">
                                        <option  value=""> {{trans('main.select')}} {{trans('main.type')}}</option>
                                        @foreach($types as $type)
                                            <option  value="{{$type->id}}">{{$type->name}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{trans('main.from')}}</label>
                                    <input type="date" class="form-control" name="from">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.to')}}</label>
                                    <input type="date" class="form-control" name="to">
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
    <script>

        $(document).ready(function () {
//
            $('#updateAsset').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var type = $(e.relatedTarget).data('type');
                var from = $(e.relatedTarget).data('from');
                var to = $(e.relatedTarget).data('to');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('select[name="type"]').val(type);
                $(e.currentTarget).find('input[name="from"]').val(from);
                $(e.currentTarget).find('input[name="to"]').val(to);
                $(e.currentTarget).find('form').attr('action', "{{url('hr/payroll/')}}/" + Id);
            });


        })
    </script>

@stop
