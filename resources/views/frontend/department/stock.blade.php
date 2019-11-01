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
                        <div class="form-group col-10">
                            <label class="col-form-label ">{{trans('main.department')}} {{trans('main.stock')}}  </label>

                            <select id="department_id" name='department_id'
                                    class="form-control" required>
                                @foreach($departments as $department_d)
                                <option value="{{$department_d->id}}"> {{$department_d->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-2">
                            <label class="col-form-label "> </label>
                            <input type="submit" class="btn btn-primary form-control">
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
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">         <thead>
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
                                    <td>{{$product->assignQuantity($department)-$product->cookedProduct($department) }}</td>
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




                $("#datatable-responsive").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
            });
        })
    </script>

@stop






