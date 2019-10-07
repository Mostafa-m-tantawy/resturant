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
                        Multiple Controls
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

{{--                            <a href="{{route('supplier.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">--}}
{{--                                <i class="la la-plus"></i>--}}
{{--                                New Record--}}
{{--                            </a>--}}
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
                    <th> ID</th>
                    <th>Name</th>
                    <th>unit</th>
                    <th>barcode</th>
                    <th>reorder point</th>
                    <th>vat</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)


                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
{{--                    <td>{{$product->unit->name}}</td>--}}
                    <td>1</td>
                    <td>{{$product->barcode}}</td>
                    <td>{{$product->reorder_point}}</td>
                    <td>{{$product->vat}}</td>
                    <td>
                        <a title="update"
                           data-toggle="modal" data-target=".bd-example-modal-lg"
                           data-id="{{$product->id}}" data-name="{{$product->name}}" data-unit="1"
                           data-barcode="{{$product->barcode}}" data-vat="{{$product->vat}}" data-reorder="{{$product->reorder_point}}"><i class="flaticon-edit-1"></i>
                        </a>
                        <a title="delete" href="{{url('product/delete/'.$product->id)}}"> <i style="color: red"
                                                                               class="flaticon-delete"></i></a>
                    </td>

                </tr>
                @endforeach
{{--                {{dd($products)}}--}}



                </tbody>
                </table>
                <form action="{{url('/product/create/'.$supplier_id)}}" method="post">
                    @csrf
                    <div class="row" id="kt_repeater_2" class="repeater">

                        <div class="col-2">name</div>
                        <div class="col-2">unit</div>
                        <div class="col-2">barcode</div>
                        <div class="col-2">reorder</div>
                        <div class="col-2">vat</div>
                        <div class="col-2">
                            <a href="javascript:;" data-repeater-create=""
                                              class="btn btn-bold btn-sm btn-label-brand pull-right">
                                <i class="la la-plus"></i> Add
                            </a>
                        </div>

                        <div class="col-12" data-repeater-list="product_g">
                            <div class="row" data-repeater-item>

                                <div class="col-2"><input type="text"  class="form-control" name="name">
                                                         </div>
                                <div class="col-2"><select name="unit" class="form-control">
                                  @foreach($units as $unit )
                                        <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                      @endforeach
                                    </select></div>
                                <div class="col-2"><input type="text"  class="form-control" name="barcode">
                                                        </div>
                                <div class="col-2"><input type="text"  class="form-control" name="reorder"
                                                         ></div>
                                <div class="col-2">
                                    <input type="number" class="form-control" name="vat" >
                                </div>
                                <div class="col-2" style=" display: flex;
  justify-content: center;
  align-items: center">
                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                        <i class="la la-remove"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="updatemodel" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('product/update/'.$supplier_id)}}" method="post">
                    <div class="modal-header">
                    <h5 class="modal-title">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <label>id</label>
                                    <input type="text" readonly class="form-control" name="id" >
                                </div>
                                <div class="col-12">
                                    <label>name</label>
                                    <input type="text" class="form-control" name="name" >
                                </div>
                                <div class="col-12">

                                    <label>unit</label>
                                    <select name="unit" class="form-control">
                                    @foreach($units as $unit )
                                        <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                    @endforeach
</select>                        </div>
                                <div class="col-12">
                                    <label>barcode</label>
                                    <input type="text" class="form-control" name="barcode" >
                                </div>
                                <div class="col-12">
                                    <label>reorder</label>
                                    <input type="text" class="form-control" name="reorder" >
                                </div>
                                <div class="col-12">
                                    <label>vat</label>
                                    <input type="number" class="form-control" name="vat" >
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="col-12 pull-left">
                        <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
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
                var reorder = $(e.relatedTarget).data('reorder');
                var barcode = $(e.relatedTarget).data('barcode');
                var vat = $(e.relatedTarget).data('vat');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('select[name="unit"]').val(unit);
                $(e.currentTarget).find('input[name="reorder"]').val(reorder);
                $(e.currentTarget).find('input[name="barcode"]').val(barcode);
                $(e.currentTarget).find('input[name="vat"]').val(vat);
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
