@extends('layouts.welcome')

@section('title')
    {{trans('main.edit assign')}}
@stop
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box" id="app">

                            <h4 class="m-t-0 header-title"><b> {{ trans('main.purses') }}</b></h4>
                            <p>

                            </p>

                            <hr>
                            <form class="form-horizontal" role="form"
                                  action="{{url('stock//save-purses-product/'.$purses->id)}}" method="post"
                                  enctype="multipart/form-data" data-parsley-validate novalidate>
                                {{csrf_field()}}

                                <div class="row">

                                    <div class="form-group col-4">
                                        <input type="hidden" value="{{$purses->id}}" id="purses_id">

                                        <label for=""
                                               class=" control-label"> {{ trans('main.select') }}  {{ trans('main.product') }}</label>
                                        <select name="product_id" id="product" class="form-control" required>
                                            <option
                                                value=""> {{ trans('main.select') }}  {{ trans('main.one') }}</option>
                                            @foreach($products as $product)
                                                <option data-vat="{{$product->vat}}"
                                                        value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="vat" name="vat">
                                    </div>

                                    <div class="form-group col-4">
                                        <label class=" control-label" for="example-email">
                                            {{ trans('main.quantity') }} (<span class="input-group-addon"
                                                                                id="unit"> {{ trans('main.unit') }}</span>)</label>
                                        <input type="text" id="quantity" name="quantity" step="0.01" min="0"
                                               class="form-control" placeholder="Quantity">

                                    </div>

                                    <div class="form-group col-4">
                                        <label class=" control-label"
                                               for="example-email"> {{ trans('main.unit') }}  {{ trans('main.price') }}
                                        </label>
                                        <input type="number" min="1" name="unit_price" class="form-control"
                                               placeholder="Unit Price" required id="unitPrice">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for=""
                                               class=" control-label"> {{ trans('main.child') }}  {{ trans('main.unit') }}  {{ trans('main.price') }}
                                            ( <span class="input-group-addon" id="child_unit"> </span>)</label>
                                        <div class="input-group">
                                            <input readonly type="text" id="child_unit_price"
                                                   name="child_unit_price"
                                                   class="form-control"
                                                   placeholder="Child Unit Price">

                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label class=" control-label"
                                               for="example-email"> {{ trans('main.gross') }}  {{ trans('main.price') }}</label>

                                        <div class="input-group">
                                            <input disabled type="number" min="1" name="product_name"
                                                   class="form-control" placeholder="Gross Price" required
                                                   id="grossPrice">
                                            <span class="input-group-addon"
                                                  id=""></span>
                                        </div>

                                    </div>


                                    <div class="form-group col-4">
                                        <label class="control-label"></label>
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
                                            <th> {{ trans('main.vat') }}</th>
                                            <th> {{ trans('main.gross') }}  {{ trans('main.price') }}</th>
                                            <th width="95px"> {{ trans('main.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 1; ?>
                                        @foreach($purses->pursesProducts as $product)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$purses->supplier->user->name}}</td>
                                                <td>{{$product->product->name}}</td>
                                                <td>{{$product->quantity}}</td>
                                                <td>{{$product->unit_price}} </td>
                                                <td>{{$product->unit_price}} </td>
                                                <th>{{($product->vat_value)?$product->vat_value:0}} </th>
                                                <th>{{$product->total}} </th>

                                                <td>
                                                    @if(($purses->pursesProducts->count()) >= 1)
                                                        <a href="{{url('stock/deleted-purses-product/'.$product->id)}}">
                                                            <i style="color: red" class="flaticon-delete"></i>
                                                        </a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach

                                        <?php
                                        //                            $pursesPrice = $purses->pursesProducts->sum('gross_price');
                                        //                            $pursesPaymentPrice = $purses->pursesPayments->sum('payment_amount');

                                        ?>

                                        <tr>
                                            <th colspan="5"></th>
                                            <th class="text-right">{{trans('main.sup-total')}} :</th>
                                            <th>{{ number_format($purses->total -$purses->vat,2,'.',',')}}</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5"></th>
                                            <th class="text-right">{{trans('main.vat')}} :</th>
                                            <th>{{ number_format($purses->vat,2,'.',',')}}</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5"></th>
                                            <th class="text-right">{{trans('main.total')}} :</th>
                                            <th>{{ number_format($purses->total,2,'.',',')}}</th>
                                            <th></th>
                                        </tr>


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

    <script src="{{ url('/app_js/PursesUpdateController.js') }}"></script>

    <script>
        function confirmDelete(url) {
            var con = confirm(' {{ trans("main.Are you sure, you want to delete this item from this purses ?")}}');
            if (con) {
                //console.log('Confirm');
                //console.log(url);
                location.replace(url);
            } else {
                //console.log('not confirm')
            }
        }
    </script>



@endsection
