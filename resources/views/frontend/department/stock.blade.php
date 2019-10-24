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
                       {{trans('main.stock')}} {{trans('main.report')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">


                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form method="post" action="{{route('department.stock')}}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-5">
                            <label class="col-form-label ">{{trans('main.department')}} {{trans('main.stock')}}  </label>

                            <select id="department_id" name='department_id'
                                    class="form-control" required>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}"> {{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-5">
                            <label class="col-form-label ">{{trans('main.calculation')}} {{trans('main.method')}}  </label>

                            <select id="price_math_method" name='price_math_method'
                                    class="form-control">
                                <option @if($method=='last_price') selected @endif value="last_price">
                                    {{trans('main.Last Purchased Price')}}
                                </option>
                                <option @if($method=='avg_price') selected @endif value="avg_price">
                                    {{trans('main.Average price')}}

                                </option>
                            </select>
                        </div>

                        <div class="form-group col-md-5 " id="stock_range_date"
                             style="display:none;">
                            <label class="col-form-label ">     {{trans('main.date')}} {{trans('main.range')}}  </label>

                            <div class='input-group pull-right' id='kt_daterangepicker_6'>
                                <input type='text' class="form-control" readonly
                                       name="rangeofdate" @if($from && $to)value="{{$from .' / '.$to }}"@endif
                                       placeholder="Select date range"/>
                                <div class="input-group-append">
                                                            <span class="input-group-text"><i
                                                                    class="la la-calendar-check-o"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-2" style="align-self: flex-end">
                            <input type="submit" value="Generate" class="btn btn-primary">
                        </div>


                    </div>
                </form>
                <!--end:  -->

                <!--begin: separator -->
                @if(isset($products))
                    @if($products->count()>0)
                        <div
                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                        <!--end: separator -->

                        <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th> {{trans('main.name')}}</th>
                                <th> {{trans('main.quantity')}}  {{trans('main.available')}}</th>
                                <th> {{trans('main.unit')}} {{trans('main.price')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->assignQuantity($department) }}</td>
                                    <td>{{$product->price($method,$from,$to) }}</td>
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

                $("#datatable-responsive").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
            });
        })
    </script>

@stop






