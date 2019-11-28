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
                        {{trans('main.approve types')}}
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
                        <th>{{trans('main.employee')}}</th>
                        <th>{{trans('main.date')}}</th>
                        <th>{{trans('main.check in')}} </th>
                        <th>{{trans('main.check out')}}</th>
                        <th>{{trans('main.delete')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{$attendance->id}}</td>
                            <td>{{$attendance->employee->name}}</td>
                            <td>{{$attendance->attendance_date}}</td>
                            <td>{{$attendance->check_in}}</td>
                            <td>
                                <form method="post"  action="{{route('attendance.checkout',[$attendance->id])}}">
                                    @csrf
                                    <button class="btn btn-primary"> {{trans('main.checkout')}}</button>
                                </form>
                            <td>
                             <form method="post"
                                   onsubmit="deleteConfirm(event,'{{trans('main.asset')}}')"
                                   action="{{route('attendance.destroy',[$attendance->id])}}">
                                 @csrf
                                 @method('DELETE')
                                 <button class="btn btn-danger"> {{trans('main.delete')}}</button>
                             </form>
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
                                    <label>{{trans('main.name')}}</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.description')}}</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                                <div class="form-group col-12">
                                    <label>{{trans('main.cost')}}</label>
                                    <input type="text" class="form-control" name="cost">
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
                <form action="{{route('attendance.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new attendance')}} <span
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


                                <div class="form-group">
                                    <label>{{trans('main.date')}}</label>
                                    <input type="text" disabled value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.checkin')}}</label>
                                    <input type="text" disabled  value="{{\Carbon\Carbon::now()->toTimeString()}}" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>{{trans('main.employee')}}</label>
                             <select name="employee_id" class="form-control">
                                 <option value="">{{trans('main.select')}} {{trans('main.employee')}}</option>
                                 @foreach($employees as $employee)
                                     <option value="{{$employee->id}}">{{$employee->name}}</option>
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
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    {{----}}
    <script>

        $(document).ready(function () {
//
            $('#updateAsset').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var description = $(e.relatedTarget).data('description');
                var cost = $(e.relatedTarget).data('cost');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('input[name="description"]').val(description);
                $(e.currentTarget).find('input[name="cost"]').val(cost);
                $(e.currentTarget).find('form').attr('action', "{{url('asset/')}}/" + Id);
            });


        })
    </script>

@stop
