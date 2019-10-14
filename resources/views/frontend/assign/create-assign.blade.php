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
                            <h4 class="m-t-0 header-title"><b> {{ trans('main.purses') }}</b></h4>
                            <hr>
                            <form class="form-horizontal" role="form" action="#" id="purses" method="post"
                                  enctype="multipart/form-data" data-parsley-validate novalidate>
                                {{csrf_field()}}
                                <div class="row">

                                    <div class="form-group col-4">
                                        <label for=""
                                               class=" control-label">  {{ trans('main.assign') }} {{ trans('main.to') }}</label>
                                        <select name="assignable_id" id="assignable_id" class="form-control " required>
                                            <option value=""> {{ trans('main.select') }}   {{ trans('main.department') }} </option>
                                            @foreach($restaurant->departments as $department )
                                                <option value="{{$department->id}}">{{$department->name}} </option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for=""
                                               class=" control-label"> {{ trans('main.select') }}  {{ trans('main.product') }}</label>
                                        <select name="product" id="product" class="form-control" required>
                                            <option value=""> {{ trans('main.select') }}   {{ trans('main.product') }} </option>
                                            @foreach( $products as $product)
                                                @if($product->quantityAvailable)
                                                    <option value="{{$product->id}}"
                                                            data-quantity="{{$product->quantity}}">{{$product->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-4">
                                        <label class=" control-label"
                                               for="example-email"> {{ trans('main.quantity') }} (
                                            <span class="input-group-addon" id="unit"> </span>) </label>
                                        <div class="input-group ">
                                            <input type="number" required id="quantity" name="quantity"
                                                   class="form-control" maxlength="12" min="0"
                                            >
                                        </div>
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
                                    <table id="datatable-responsive"
                                           class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ trans('main.assign') }} {{ trans('main.type') }}</th>
                                            <th> {{ trans('main.assign') }} {{ trans('main.to') }}</th>
                                            <th> {{ trans('main.product') }}</th>
                                            <th > {{ trans('main.quantity')}}</th>
                                            <th > {{ trans('main.action') }}</th>
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

    <script src="{{ url('/app_js/AssignController.js') }}"></script>


@endsection
