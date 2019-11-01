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


            </div>

            <div class="kt-portlet__body">
                <form method="post" action="{{route('dashboard')}}">
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
                <div class="row">
                    <div class="col-xl-8">

                        <!--begin:: Widgets/Product Sales-->
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('main.sales')}}
                                        <small> {{trans('main.total')}}  {{trans('main.sales')}}</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget25">
                                    <span class="kt-widget25__stats m-font-brand">${{$total}}</span>
                                    <span class="kt-widget25__subtitle">
                                        {{trans('main.total')}} {{trans('main.sales')}}
                                        {{trans('main.from')}} {{$from}} {{trans('main.to')}} {{$to}} </span>
                                    <div class="kt-widget25__items">
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$sup_total}}
														</span>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar kt-bg-danger" role="progressbar"
                                                     style="width: @if($total!=0){{($sup_total/$total)*100}}% @else 0% @endif" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.sup-total')}}
														</span>
                                        </div>
                                        <div class="kt-widget25__item">
														<span class="kt-widget25__number">
															${{$service}}
														</span>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar kt-bg-success" role="progressbar"
                                                     style="  width: @if($total!=0){{($service/$total)*100}}% @else 0% @endif; " aria-valuenow="50" aria-valuemin="0"
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
                                                     style=" width: @if($total!=0){{($vat/$total)*100}}% @else 0% @endif;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="kt-widget25__desc">
															{{trans('main.vat')}}
														</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Product Sales-->

                    </div>
                    <div class="col-xl-4">

                        <!--begin:: Widgets/Authors Profit-->
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('main.top Dishes')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget4">
                              @foreach($orderdetails->take(3) as $dish)
                                    <div class="kt-widget4__item">
                                        <div class="kt-widget4__pic kt-widget4__pic--logo">
                                            <img src="{{url($dish->dishSize->dish->image)}}" alt="">
                                        </div>
                                        <div class="kt-widget4__info">
                                            <a href="#" class="kt-widget4__title">
                                               {{$dish->dishSize->dish->name}}
                                            </a>
                                            <p class="kt-widget4__text">
                                                {{$dish->dishSize->dish->description}}

                                            </p>
                                        </div>
                                        <span class="kt-widget4__number kt-font-brand">+{{$dish->total_points}}</span>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Authors Profit-->
                    </div>

                </div>
                <div class="row">
{{--                    <div class="col-xl-8">--}}

{{--                        <!--begin:: Widgets/Product Sales-->--}}
{{--                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">--}}
{{--                            <div class="kt-portlet__head">--}}
{{--                                <div class="kt-portlet__head-label">--}}
{{--                                    <h3 class="kt-portlet__head-title">--}}
{{--                                        {{trans('main.sales')}}--}}
{{--                                        <small> {{trans('main.total')}}  {{trans('main.sales')}}</small>--}}
{{--                                    </h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="kt-portlet__body">--}}
{{--                                <div class="kt-widget25">--}}
{{--                                    <span class="kt-widget25__stats m-font-brand">${{$total}}</span>--}}
{{--                                    <span class="kt-widget25__subtitle">--}}
{{--                                        {{trans('main.total')}} {{trans('main.sales')}}--}}
{{--                                        {{trans('main.from')}} {{$from}} {{trans('main.to')}} {{$to}} </span>--}}
{{--                                    <div class="kt-widget25__items">--}}
{{--                                        <div class="kt-widget25__item">--}}
{{--														<span class="kt-widget25__number">--}}
{{--															${{$sup_total}}--}}
{{--														</span>--}}
{{--                                            <div class="progress kt-progress--sm">--}}
{{--                                                <div class="progress-bar kt-bg-danger" role="progressbar"--}}
{{--                                                     style="width: @if($total!=0){{($sup_total/$total)*100}}% @else 0% @endif" aria-valuenow="50" aria-valuemin="0"--}}
{{--                                                     aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="kt-widget25__desc">--}}
{{--															{{trans('main.sup-total')}}--}}
{{--														</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-widget25__item">--}}
{{--														<span class="kt-widget25__number">--}}
{{--															${{$service}}--}}
{{--														</span>--}}
{{--                                            <div class="progress m-progress--sm">--}}
{{--                                                <div class="progress-bar kt-bg-success" role="progressbar"--}}
{{--                                                     style="  width: @if($total!=0){{($service/$total)*100}}% @else 0% @endif; " aria-valuenow="50" aria-valuemin="0"--}}
{{--                                                     aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="kt-widget25__desc">--}}
{{--															{{trans('main.service')}}--}}
{{--														</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="kt-widget25__item">--}}
{{--														<span class="kt-widget25__number">--}}
{{--															${{$vat}}--}}
{{--														</span>--}}
{{--                                            <div class="progress m-progress--sm">--}}
{{--                                                <div class="progress-bar kt-bg-warning" role="progressbar"--}}
{{--                                                     style=" width: @if($total!=0){{($vat/$total)*100}}% @else 0% @endif;" aria-valuenow="50" aria-valuemin="0"--}}
{{--                                                     aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                            <span class="kt-widget25__desc">--}}
{{--															{{trans('main.vat')}}--}}
{{--														</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!--end:: Widgets/Product Sales-->--}}

{{--                    </div>--}}
                    <div class="col-xl-4">

                        <!--begin:: Widgets/Authors Profit-->
                        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('main.top Dishes')}}
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

                </div>

            </div>

        </div>

        @stop
        @section('scripts')

            <script src="{{asset('js/demo1/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"
                    type="text/javascript"></script>


@stop







