@extends('layouts.welcome')
@section('style')
    <style>
        label{
            font-size: 20px !important;
            font-weight:bolder !important;

        }
    </style>
    @endsection
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
                        {{trans('main.create')}} {{trans('main.product')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{url('product/index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.all')}} {{trans('main.products')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{trans('main.create')}} {{trans('main.product')}}
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" method="post" action="{{route('product.store')}}">
                        @csrf  <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-md-12">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <h3>{{trans('main.product')}} {{trans('main.information')}}</h3>
                                        <br>
                                        <br>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>{{trans('main.product')}} {{trans('main.name')}}</label>
                                            <input type="text"required name="name" class="form-control" placeholder=" {{trans('main.name')}} ">
                                        </div>

                                        <div class="col-12">
                                            <label class="">{{trans('main.unit')}} </label>
                                            <select name="unit" class="form-control">
                                                <option value="">{{trans('main.select')}} {{trans('main.unit')}}</option>
                                                @foreach($units as $unit )
                                                    <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="">{{trans('main.category')}}</label>
                                            <select name="category" class="form-control">
                                                <option value="">{{trans('main.select')}} {{trans('main.category')}}</option>

                                            @foreach($categories as $category )
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>

                                        <div class="col-12">
                                            <label  style="display: table-cell" class="">{{trans('main.Is product Stockable')}}   </label>
                                            <span class="kt-switch kt-switch--lg kt-switch--icon">
											<label>
											<input type="checkbox" checked="checked" name="is_stockable">
												<span></span>
												</label>
											</span>
                                        </div>

                                       <div class="col-12">
                                            <label class=""> {{trans('main.re-order point')}}  :</label>
                                            <input type="number" min="0" step=".001" name="reorder_point" class="form-control" placeholder="{{trans('main.enter')}} {{trans('main.description')}}">
                                        </div>


                                        <div class="col-12">
                                            <label class="">{{trans('main.barcode')}}  </label>
                                            <input type="text" name="barcode" class="form-control" placeholder="{{trans('main.enter')}} {{trans('main.barcode')}}">

                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary">{{trans('main.submit')}}</button>
                                        <button type="reset" class="btn btn-secondary">{{trans('main.cancel')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

            </div>
        </div>

    </div>

@stop
@section('scripts')


@stop
