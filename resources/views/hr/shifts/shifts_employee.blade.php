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

                            <a href="#" data-toggle="modal" data-target="#newapprover"
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
                            <th>{{trans('main.shift')}}</th>
                            <th>{{trans('main.employee')}}</th>
                            <th>{{trans('main.delete')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($shift->employees as $employee)
                        {{----}}
                        {{--                        {{dd()}}--}}
                        <tr><td>
{{$loop->index+1}}</td>
                            <td>{{$shift->name}}</td>
                            <td>{{ $employee->name}}</td>
                            <td>
                                <form method="post"  onsubmit="deleteConfirm(event,'{{trans('main.employee shift')}}')"
                                      action="{{url('hr/detach-shift')}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="shift_id" value="{{$shift->id}}">
                                    <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                    <button class="btn btn-danger"> {{trans('main.delete')}}</button>
                                </form>
                            </td>
                            </td>

                            {{----}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="modal fade newapprover" id="newapprover" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('hr/attach-shift')}}" method="post">

                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new employee shift')}} <span
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
                                <input type="hidden" class="form-control" name="shift_id" value="{{$shift->id}}">

                                <div class="form-group">
                                    <label class=" control-label">{{trans('main.employee')}}  </label>
                                    <select class=" form-control"
                                            name="employee_id" required>
                                        <option value=""> {{trans('main.select')}} {{trans('main.employee')}} </option>
                                       @foreach($employees  as $employee)
                                        <option value="{{$employee->id}}"> {{$employee->name}} </option>
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
