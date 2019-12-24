@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
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
                        {{trans('main.department')}} {{trans('main.index')}}
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{route('employee.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.record')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table id="datatable-responsive"
                       class="display table table-striped table-bordered " cellspacing="0"
                       style="width:100%">

                    <thead>
                    <tr>
                        <th> {{trans('main.id')}}</th>
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.department')}}</th>
                        <th>{{trans('main.gender')}}</th>
                        <th>{{trans('main.civil status')}}</th>
                        <th>{{trans('main.date of joining')}}</th>
                        <th>{{trans('main.salary')}}</th>
                        <th>{{trans('main.bank account')}}</th>
                        <th>{{trans('main.bank name')}}</th>
                        <th>{{trans('main.profile')}}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{$employee->id}}</td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->department? $employee->department->name:''}}</td>
                            <td>{{$employee->gender}}</td>
                            <td>{{$employee->civil_status}}</td>
                            <td>{{$employee->date_of_joining}}</td>
                            <td>{{$employee->salary}}</td>
                            <td>{{$employee->bank_account}}</td>
                            <td>{{$employee->bank_name}}</td>

                            <td>
                                <a href="{{route('employee.show',[$employee->id])}}" title="products">
                                    <span>{{trans('main.profile')}}</span>
                                    <i  class="la la-edit" style="font-size: 25px;"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>

        </div>
    </div>

@stop
@section('scripts')


@stop
