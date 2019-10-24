@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
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
                        {{ trans('main.purchases') }} {{ trans('main.summery') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{url('purchase')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{ trans('main.new') }}  {{ trans('main.purchase') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table id="datatable-responsive"
                       class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>  {{ trans('main.id') }}</th>
                        <th> {{ trans('main.supplier') }} </th>
                        <th>  {{ trans('main.total') }}</th>
                        <th> {{ trans('main.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purses as $purchase)
                        <tr>
                            <td>{{$purchase->id}}</td>
                            <td>{{$purchase->supplier->user->name}}</td>
                            <td>{{$purchase->total}}</td>

                            <td>
                                <a title="Show" href="{{url('purchase/show/'.$purchase->id)}}"> <i  class="fa fa-book-open"></i></a>

{{--                                <a title="delete" href="{{url('product/delete/'.$product->id)}}"> <i style="color: red"--}}
{{--                                                                                                     class="flaticon-delete"></i></a>--}}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>

        </div>
    </div>

@stop
@section('scripts')

    <script>
        $(document).ready(function () {
            $("#datatable-responsive").DataTable({
                order: [0, 'desc'],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf','print'
                ],
            });  })
    </script>

@stop
























