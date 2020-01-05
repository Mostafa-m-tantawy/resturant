@extends('.pos.layout.pos_app')

@section('title')
    {{trans('main.index order')}}
@stop



@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>

@stop
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile">

            @foreach($allorders as $orders)
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
            @endforeach

        </div>
    </div>

@stop
