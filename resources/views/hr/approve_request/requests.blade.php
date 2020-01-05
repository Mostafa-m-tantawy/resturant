@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('title')
    {{trans('main.my requests')}}
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
                        {{trans('main.my requests')}}
                    </h3>
                </div>

            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table id="datatable-responsive"
                       class="display table table-striped table-bordered " cellspacing="0"
                       style="width:100%"> <thead>



                    <tr>
                        <th> {{trans('main.id')}}</th>
                        <th>{{trans('main.who Request')}}</th>
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.approve type')}}</th>
                        <th>{{trans('main.subject')}}</th>
                        <th>{{trans('main.status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>{{$request->id}}</td>
                            <td>{{$request->whoRequest->name}}</td>
                            <td>{{$request->name}}</td>
                            <td>{{$request->ApproveType->name}}</td>
                            <td>{{$request->subject}}</td>
                            <td>{{$request->status}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>

        </div>
    </div>

@stop
