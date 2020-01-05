@extends('.pos.layout.pos_app')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop


@section('title')
    {{trans('main.dashboard')}}
@stop



@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">


            <div class="kt-portlet__body">
                <form method="post" action="{{route('dashboard.pos')}}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-8">
                            <label class=""> {{trans('main.date')}}  {{trans('main.range')}}</label>
                            <div class='input-group pull-right' id='kt_daterangepicker_6'>
                                <input type='text' name="range" class="form-control" readonly
                                       value="{{$from.' / '. $to}}"
                                       placeholder="{{trans('main.date')}}  {{trans('main.range')}}"/>
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
                <div class="row">
                    <div class="col-12">
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('main.sales')}}
                                        <small>{{trans('main.total sales')}}</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget25">
                                    <span class="kt-widget25__stats m-font-brand">${{$total}}</span>
                                    <span class="kt-widget25__subtitle">
                                        <br>
                                        {{trans('main.total sales')}}
                                        <br>
                                        {{trans('main.from')}} {{$from}} -  {{trans('main.to')}} - {{$to}}</span>
                                    <div class="kt-widget25__items">
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$sup_total}}
														</span>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar kt-bg-success" role="progressbar"
                                                     style="width: {{100*$sup_total/(($total)?$total:1)}}% " aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.sub total')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$service}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-warning " role="progressbar"
                                                     style="  width: {{100*$service/(($total)?$total:1)}}% ; " aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.service')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$vat}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-warning" role="progressbar"
                                                     style=" width: {{100*$vat/(($total)?$total:1)}}% ;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.vat')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$discount}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-danger" role="progressbar"
                                                     style=" width: {{100*$discount/(($total)?$total:1)}}% ;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.discount')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
																${{$delivery}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-warning" role="progressbar"
                                                     style=" width: {{100*$delivery/(($total)?$total:1)}}% ;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>

                                            <span class="kt-widget25__desc">
															{{trans('main.delivery')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$coupon}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar  kt-bg-danger " role="progressbar"
                                                     style=" width: {{100*$coupon/(($total)?$total:1)}}% ;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>

                                            <span class="kt-widget25__desc">
															{{trans('main.coupon')}}
														</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                <div class="col-8">
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('main.sales')}}
                                        <small>{{trans('main.total payments')}}</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget25">
                                    <span class="kt-widget25__stats m-font-brand">${{$total_payment}}</span>
                                    <span class="kt-widget25__subtitle">
                                        <br>
                                        {{trans('main.total sales')}}
                                        <br>
                                        {{trans('main.from')}} {{$from}} -  {{trans('main.to')}} - {{$to}}</span>
                                    <div class="kt-widget25__items">
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$cash}}
														</span>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar kt-bg-success" role="progressbar"
                                                     style="width: {{100*$cash/(($total_payment)?$total_payment:1)}}% " aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.cash')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$credit_card}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar  kt-bg-success" role="progressbar"
                                                     style="  width: {{100*$credit_card/(($total_payment)?$total_payment:1)}}% ; " aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.credit card')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$check}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar  kt-bg-success" role="progressbar"
                                                     style=" width: {{100*$check/(($total_payment)?$total_payment:1)}}% ;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.check')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$account}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar  kt-bg-success" role="progressbar"
                                                     style=" width: {{100*$account/(($total_payment)?$total_payment:1)}}% ;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.account')}}
														</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('main.order')}}
                                        <small>{{trans('main.order count')}}</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget25">
                                    <span class="kt-widget25__stats m-font-brand">{{$orders->count()}}</span>
                                    <span class="kt-widget25__subtitle">
                                        <br>
                                        {{trans('main.order count')}}
                                        <br>
                                        {{trans('main.from')}} {{$from}} -  {{trans('main.to')}} - {{$to}}</span>
                                    <div class="kt-widget25__items">
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															{{$closedOrders}}
														</span>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar kt-bg-success" role="progressbar"
                                                     style="width: {{100*$closedOrders/(($orders->count())?$orders->count():1)}}% " aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.closed orders')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															{{$openOrders}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-warning " role="progressbar"
                                                     style="  width: {{100*$openOrders/(($orders->count())?$orders->count():1)}}% ; " aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.open orders')}}
														</span>
                                        </div>

                                    </div>
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







