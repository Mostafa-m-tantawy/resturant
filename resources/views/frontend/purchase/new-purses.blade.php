@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">

                <div class="row">
                    <div class="col-12">
                        <div class="card-box" id="app">
                            <h4 class="m-t-0 header-title"><b>  {{ trans('main.purchases') }}</b></h4>
                            <hr>
                            <form class="form-horizontal" role="form" action="#" id="purses" method="post"
                                  enctype="multipart/form-data" data-parsley-validate novalidate>
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="form-group col-4">
                                           <label for="" class=" control-label">  {{ trans('main.supplier') }}</label>
                                        <select name="supplier_id" id="supplier_id" class="form-control " required>
                                            <option
                                                value=""> {{ trans('main.select') }}  {{ trans('main.one') }}</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""
                                               class=" control-label"> {{ trans('main.select') }}  {{ trans('main.product') }}</label>
                                        <select name="product_id" id="product" class="form-control" required>

                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label class=" control-label"
                                               for="example-email"> {{ trans('main.quantity') }} (
                                            <span class="input-group-addon" id="unit"> </span>) </label>
                                        <div class="input-group ">
                                            <input type="text" id="quantity" name="quantity"
                                                   class="form-control"
                                                   placeholder="Quantity">
                                         </div>
                                    </div>


                                    <div class="form-group col-4">
                                        <label class=" control-label"
                                               for="example-email"> {{ trans('main.unit') }}  {{ trans('main.price') }}
                                            :</label>
                                        <input type="number" step="0.01" min="0" name="unit_price" class="form-control"
                                               placeholder="Unit Price"
                                               parsley-trigger="change" required id="unitPrice">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""
                                               class=" control-label"> {{ trans('main.child') }}  {{ trans('main.unit') }}  {{ trans('main.price') }}
                                        (    <span class="input-group-addon" id="child_unit"> </span>)</label>

                                            <input disabled type="text" id="child_unit_price" name="quantity"
                                                   class="form-control" step="0.01" min="0"
                                                   placeholder="Child Unit Price">

                                    </div>

                                    <div class="form-group col-4">
                                            <label class=" control-label" for="example-email"> {{ trans('main.gross') }}  {{ trans('main.price') }}</label>
                                            <input disabled type="number" min="1" name="product_name"
                                                   class="form-control" placeholder="Gross Price" required id="grossPrice">


                                    </div>

                                    <div class="form-group col-12">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                                {{ trans('main.purses') }}  {{ trans('main.now') }}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="p-20">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ trans('main.supplier') }}</th>
                                            <th> {{ trans('main.product') }}</th>
                                            <th width="100px"> {{ trans('main.quantity') }}</th>
                                            <th width="150px"> {{ trans('main.unit') }}  {{ trans('main.price') }}</th>
                                            <th> {{ trans('main.child') }}  {{ trans('main.unit') }}  {{ trans('main.price') }}</th>
                                            <th> {{ trans('main.gross') }}  {{ trans('main.price') }}</th>
                                            <th width="95px"> {{ trans('main.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="pursesDetailsRender">


                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ url('/app_js/PursesController.js') }}"></script>



@endsection
