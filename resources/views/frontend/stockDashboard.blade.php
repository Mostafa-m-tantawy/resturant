@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('title')
    {{trans('main.stock Dashboard')}}
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


            </div>

            <div class="kt-portlet__body">
               <div class="row">

                    <div class="col-md-6">
                        <!--begin:: Widgets/Authors Profit-->
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('main.reach re-order point')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget4">
                                    @foreach($products as $product)
                                        <div class="kt-widget4__item">
                                            <div class="kt-widget4__pic kt-widget4__pic--logo">
                                            </div>
                                            <div class="kt-widget4__info">
                                                <a href="#" class="kt-widget4__title">
                                                    {{$product->name}}
                                                </a>
                                                <p class="kt-widget4__text">
                                                    {{$product->description}}

                                                </p>
                                            </div>
                                            <span class="kt-widget4__number kt-font-brand">+{{$product->quantity}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Authors Profit-->
                    </div>
                    <div class="col-md-6">
                        <!--begin:: Widgets/Authors Profit-->

                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            {{trans('main.financial')}} {{trans('main.receivables')}}
                                        </h3>
                                    </div>

                                </div>  <div class="kt-portlet__body">
                                    <div class="kt-widget1 kt-widget1--fit">
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title"> {{trans('main.suppliers')}}</h3>
                                                <span class="kt-widget1__desc">{{trans('main.suppliers')}} {{trans('main.start')}} {{trans('main.balance')}}</span>
                                            </div>
                                            <span class="kt-widget1__number kt-font-brand">+${{number_format($restaurant->suppliers->sum('start_balance'),2)}}</span>
                                        </div>
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">{{trans('main.purchases')}}</h3>
                                                <span class="kt-widget1__desc">{{trans('main.restaurant')}} {{trans('main.gross')}} {{trans('main.purchases')}}</span>
                                            </div>
                                            <span class="kt-widget1__number kt-font-brand">+${{number_format($restaurant->GrossPurchases,2)}}</span>
                                        </div>
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">  {{trans('main.refund')}}</h3>
                                                <span class="kt-widget1__desc">{{trans('main.restaurant')}} {{trans('main.gross')}} {{trans('main.to')}} {{trans('main.supplier')}}     </span>
                                            </div>
                                            <span class="kt-widget1__number kt-font-danger">-${{number_format($restaurant->GrossRefunds,2)}}</span>
                                        </div>
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title"> {{trans('main.payment')}}</h3>
                                                <span class="kt-widget1__desc">{{trans('main.restaurant')}} {{trans('main.gross')}} {{trans('main.payment')}}  </span>
                                            </div>
                                            <span class="kt-widget1__number kt-font-danger">-${{number_format($restaurant->GrossPayments,2)}}</span>
                                        </div>
                                        <div class="kt-widget1__item">
                                            <div class="kt-widget1__info">
                                                <h3 class="kt-widget1__title">{{trans('main.dept')}}</h3>
                                                <span class="kt-widget1__desc">{{trans('main.restaurant')}}  {{trans('main.dept')}}</span>
                                            </div>
                                            <span class="kt-widget1__number kt-font-success">${{number_format($restaurant->suppliers->sum('start_balance')+$restaurant->GrossPurchases-$restaurant->GrossRefunds-$restaurant->GrossPayments,2)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end:: Widgets/Authors Profit-->
                    </div>

<div class="row">
    <div class="col-12">

    <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    {{trans('main.time filter')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form method="post" action="{{route('dashboard.stock')}}">
                @csrf
                <div class="row">
                    <div class="form-group col-8">
                        <label class=""> {{trans('main.date')}}  {{trans('main.range')}}</label>
                        <div class='input-group pull-right' id='kt_daterangepicker_6'>
                            <input type='text' name="range" class="form-control" readonly
                                   value="{{$from.' / '. $to}}"   placeholder="{{trans('main.date')}}  {{trans('main.range')}}"/>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                            </div>

                        </div>
                    </div>

                    <div class="form-group col-4" style="    display: inherit;margin-top: 10px;">
                        <button class="btn btn-primary pull-right" type="submit" value="Dashboard time">
                            {{trans('main.Dashboard time')}}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                    role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#purchase"
                           role="tab">
                            <i class="flaticon2-calendar-3"></i> {{trans('main.purchase')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#payment"
                           role="tab">
                            <i class="flaticon2-gear"></i> {{trans('main.payments')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#refund"
                           role="tab">
                            <i class="flaticon2-gear"></i> {{trans('main.refunds')}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="tab-content kt-margin-t-20">

                <!--Begin:: Tab Content-->
                <div class="tab-pane active" id="purchase" role="tabpanel">
                    <div class="kt-portlet__body" style="padding: unset">

                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    {{trans('main.purchases')}}
                                </h3>
                            </div>

                        </div>
                        <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">         <thead>
                            <tr>
                                <th>  {{ trans('main.id') }}</th>
                                <th> {{ trans('main.supplier') }} </th>
                                <th>  {{ trans('main.total') }}</th>
                                <th> {{ trans('main.action') }}</th>
                                <th> {{ trans('main.attachments') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases->take(20) as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->supplier->user->name}}</td>
                                    <td>{{$purchase->total}}</td>

                                    <td>
                                        <a title="Show" href="{{url('stock/purchase/show/'.$purchase->id)}}"> <i  class="fa fa-book-open"></i></a>
                                    </td>

                                    <td>
                                        @foreach($purchase->files as $file)
                                            <a title="Show" href="{{url('/download?url='.$file->url)}}">
                                                {{$loop->index + 1}}<i class="fa fa-cloud-download-alt"></i></a>
                                        @endforeach

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>

                <!--Begin:: Tab Content-->
                <div class="tab-pane" id="payment" role="tabpanel">

                    <div class="kt-portlet__body" style="padding: unset">

                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    {{trans('main.payments')}}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">    <thead>
                            <tr>
                                <th>  {{trans('main.id')}} </th>
                                <th>  {{trans('main.supplier')}} {{trans('main.name')}} </th>
                                <th> {{trans('main.amount')}} </th>
                                <th> {{trans('main.method')}} </th>
                                <th> {{trans('main.Due Date')}} </th>
                                <th> {{trans('main.action')}} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments->take(20) as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->sender->user->name}}</td>
                                    <td>{{$payment->payment_amount}}</td>
                                    <td>{{$payment->payment_method}}</td>
                                    <td>{{$payment->due_date}}</td>
                                    <td><a title="delete"
                                           href="{{url('stock/purchase/delete/'.$payment->id)}}">
                                            <i style="color: red" class="flaticon-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>

                </div>
                <!--End:: Tab Content-->
 <!--Begin:: Tab Content-->
                <div class="tab-pane" id="refund" role="tabpanel">

                    <div class="kt-portlet__body" style="padding: unset">

                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    {{trans('main.payments')}}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>  {{ trans('main.id') }}</th>
                                <th> {{ trans('main.supplier') }}  {{ trans('main.name') }}</th>
                                <th> {{ trans('main.product') }}</th>
                                <th> {{ trans('main.quantity') }}</th>
                                <th> {{ trans('main.unit price') }}</th>
                                <th>{{ trans('main.vat') }}</th>
                                <th>{{ trans('main.gross') }}</th>
                                <th>{{ trans('main.note') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($refunds->take(20) as $refund)
                                <tr>
                                    <td>{{$refund->id}}</td>
                                    <td>{{$refund->supplier->user->name}}</td>
                                    <td>{{$refund->product->name}}</td>
                                    <td>{{$refund->quantity}}</td>
                                    <td>{{$refund->unit_price}}</td>
                                    <td>{{$refund->vat}}</td>
                                    <td>{{($refund->quantity*$refund->unit_price)+($refund->quantity*$refund->unit_price)*($refund->vat/100) }}</td>
                                    <td>
                                        <a href="{{url('stock/refund/delete/'.$refund->id)}}" title="delete">
                                            <i style="color: red" class="flaticon-delete"></i>
                                        </a> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>
                <!--End:: Tab Content-->


            </div>
        </div>
    </div>

</div>
</div>
                </div>

            </div>

        </div>

        @stop
        @section('scripts')

            <script src="{{asset('js/demo1/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"
                    type="text/javascript"></script>


@stop







