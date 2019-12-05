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
                        {{trans('main.supplier')}} {{trans('main.products')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{route('product.create')}}"
                               class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.product')}}
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
                        <th>{{trans('main.product')}}</th>
                        <th>{{trans('main.unit')}}</th>
                        <th>{{trans('main.barcode')}}</th>
                        <th>{{trans('main.re-order point')}}</th>
                        <th>{{trans('main.vat')}}</th>
                        <th>{{trans('main.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($supplier->products as $product)


                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->unit->unit}}</td>
                            <td>{{$product->barcode}}</td>
                            <td>{{$product->reorder_point}}</td>
                            <td>{{$product->pivot->vat}}</td>
                            <td>
                                <a title="delete"
                                   href="{{url('stock/product/delete/'.$product->id.'/'.$supplier->id)}}">
                                    <i style="color: red" class="flaticon-delete"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    {{--                {{dd($products)}}--}}


                    </tbody>
                </table>
                <form action="{{url('stock/product/create/'.$supplier->id)}}" method="post">
                    @csrf
                    <div class="row" id="kt_repeater_2" class="repeater">

                        <div class="col-4">{{trans('main.product')}}</div>
                        <div class="col-4">{{trans('main.vat')}}</div>
                        <div class="col-4">
                            <a href="javascript:;" data-repeater-create=""
                               class="btn btn-bold btn-sm btn-label-brand pull-right">
                                <i class="la la-plus"></i> {{trans('main.add')}}
                            </a>
                        </div>

                        <div class="col-12" data-repeater-list="product_g">
                            <div class="row" data-repeater-item>

                                <div class="col-4">
                                    <select name="product" class="form-control">
                                        @foreach($products as $product )
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <input type="number" class="form-control" name="vat">
                                </div>
                                <div class="col-4" style=" display: flex;
  justify-content: center;
  align-items: center">
                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                        <i class="la la-remove"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                        <div class="col-12 pull-left">
                            <button type="submit"
                                    class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.submit')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
    </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>

    <script>
        $.fn.dataTableExt.ofnSearch['html-input'] = function (value) {
            return $(value).val();
        };

    </script>

@stop
