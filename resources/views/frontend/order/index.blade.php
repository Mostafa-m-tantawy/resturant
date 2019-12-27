@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        {{--        <div class="alert alert-light alert-elevate" role="alert">--}}
        {{--            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>--}}
        {{--            <div class="alert-text">--}}
        {{--                You can use the dom initialisation parameter to move DataTables features around the table to where you want them.--}}
        {{--                See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/advanced_init/dom_multiple_elements.html" target="_blank">here</a>.--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{trans('main.all')}} {{trans('main.orders')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{route('order.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                        <th>{{trans('main.sup-total')}}</th>
                        <th>{{trans('main.service')}}</th>
                        <th>{{trans('main.vat')}}</th>
                        <th>{{trans('main.discount')}}</th>
                        <th>{{trans('main.delivery')}}</th>
                        <th>{{trans('main.CouponValue')}}</th>
                        <th>{{trans('main.gross-total')}}</th>
                        <th>{{trans('main.status')}}</th>
                        <th>{{trans('main.paid')}}</th>
                        <th>{{trans('main.created_at')}}</th>
                        <th>{{trans('main.edit')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>

                            <td>{{$order->id}}</td>
                            <td>{{$order->sup_total}}</td>
                            <td>{{$order->service}}</td>
                            <td>{{$order->vat}}</td>
                            <td>{{$order->discount}}</td>
                            <td>{{$order->delivery}}</td>
                            <td>{{$order->CouponValue}}</td>
                            <td>{{$order->gross_total}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->paid}}</td>
                            <td>{{$order->created_at}}</td>

                            <td>
                                <a title="update" href="{{url('pos/order/'.$order->id.'/edit')}}">
                                    <i class="flaticon-edit-1"></i>
                                </a>
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
