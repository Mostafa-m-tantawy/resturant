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
                        {{trans('main.all')}} {{trans('main.products')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                                                        <a href="{{url('product/create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                       class="table table-striped table-bordered dt-responsive  nowrap "
                       cellspacing="0"
                       width="100%"
                >
                    <thead>
                    <tr>
                        <th>{{trans('main.id')}}</th>
                        <th>{{trans('main.category')}}</th>
                        <th>{{trans('main.name')}}</th>
                        <th>{{trans('main.unit')}}</th>
                        <th>{{trans('main.barcode')}}</th>
                        <th>{{trans('main.re-order point')}}</th>
                        <th>{{trans('main.stockable')}}</th>
                        <th>{{trans('main.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    @foreach($category->products as $product)


                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->unit->unit}}</td>
                            <td>{{$product->barcode}}</td>
                            <td>{{$product->reorder_point}}</td>
                            <td>{{($product->is_stockable)?'Yes':'No'}}</td>
                            <td>
                                <a title="update"
                                   data-toggle="modal" data-target=".bd-example-modal-lg"
                                   data-id="{{$product->id}}" data-name="{{$product->name}}"
                                   data-unit="{{$product->unit_id}}" data-is_stockable="{{$product->is_stockable}}" data-category="{{$product->product_category_id}}"
                                   data-barcode="{{$product->barcode}}"  data-reorder="{{$product->reorder_point}}"><i class="flaticon-edit-1"></i>
                                </a>
{{--                                <a title="delete" href="{{url('product/delete/'.$product->id)}}"> <i style="color: red"--}}
{{--                                                                                                     class="flaticon-delete"></i></a>--}}
                            </td>

                        </tr>
                    @endforeach
                    @endforeach
                    {{--                {{dd($products)}}--}}



                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="updatemodel" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('product/update')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.update')}} {{trans('main.product')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="container">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>  {{trans('main.id')}}</label>
                                    <input type="text"required name="id" readonly class="form-control">
                                </div>
                                <div class="col-12">
                                    <label> {{trans('main.name')}}</label>
                                    <input type="text"required name="name" class="form-control" placeholder="Enter full name">
                                </div>

                                <div class="col-12">
                                    <label class=""> {{trans('main.unit')}} </label>
                                    <select name="unit" class="form-control">
                                        <option value=""> {{trans('main.select')}}  {{trans('main.unit')}}</option>
                                        @foreach($units as $unit )
                                            <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-12">
                                    <label class="">{{trans('main.category')}} </label>
                                    <select name="category" class="form-control">
                                        <option value="">select Category</option>

                                        @foreach($categories as $category )
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label  style="display: table-cell" class="">{{trans('main.stockable')}} </label>
                                    <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" checked="checked" name="is_stockable">
												<span></span>
												</label>
											</span>
                                </div>

                                <div class="col-12">
                                    <label class="">{{trans('main.re-order point')}} :</label>
                                    <input type="number" min="0" step=".001" name="reorder_point" class="form-control" placeholder="Enter description">

                                </div>

                                <div class="col-12">
                                    <label class="">{{trans('main.barcode')}} </label>
                                    <input type="text" name="barcode" class="form-control" placeholder="Enter barcode">

                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.submit')}}</button>
                        </div>
                    </div>                    </form>

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
        $(document).ready(function () {
            $('#updatemodel').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                var unit = $(e.relatedTarget).data('unit');
                var category = $(e.relatedTarget).data('category');
                var reorder = $(e.relatedTarget).data('reorder');
                var barcode = $(e.relatedTarget).data('barcode');
                var is_stockable = $(e.relatedTarget).data('is_stockable');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('select[name="unit"]').val(unit);
                $(e.currentTarget).find('select[name="category"]').val(category);
                $(e.currentTarget).find('input[name="reorder_point"]').val(reorder);
                $(e.currentTarget).find('input[name="barcode"]').val(barcode);
                if (is_stockable == 0)
                    $(e.currentTarget).find('input[name="is_stockable"]').prop('checked', false);
            });
            $("#datatable-responsive").DataTable({
                order: [0, 'desc'],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],

            });
        })
    </script>

@stop
