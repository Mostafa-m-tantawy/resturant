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
                        {{trans('main.restaurant')}} {{trans('main.stock')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{url('purchase/create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.purchase')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: separator -->
                @if(isset($products))
                    @if($products->count()>0)
                        <div
                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                        <!--end: separator -->

                        <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">      <thead>
                            <tr>
                                <th>{{trans('main.product')}}</th>
                                <th>{{trans('main.available')}} {{trans('main.quantity')}} </th>
                                <th>{{trans('main.Unit cost')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)


                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity }}</td>
                                    <td>{{$product->cost }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                @endif
            @endif
            <!--end: Datatable -->
            </div>

        </div>
    </div>

@stop
@section('scripts')

    <script src="{{asset('js/demo1/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {


                $('#price_math_method').change(function () {
                    $('#stock_range_date').css('display', 'none');

                    if ($(this).val() == 'avg_price')
                        $('#stock_range_date').css('display', 'block');
                });


        })
    </script>

@stop






