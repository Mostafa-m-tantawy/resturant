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
                        Multiple Controls
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{route('supplier.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Record
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
                        <th> ID</th>
                        <th>Supplier name</th>
                        <th>product</th>
                        <th>quantity</th>
                        <th>unit price</th>
                        <th>vat</th>
                        <th>Gross</th>
                        <th>note</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($refunds as $refund)
                        <tr>
                            <td>{{$refund->id}}</td>
                            <td>{{$refund->supplier->user->name}}</td>
                            <td>{{$refund->product->name}}</td>
                            <td>{{$refund->quantity}}</td>
                            <td>{{$refund->unit_price}}</td>
                            <td>{{$refund->vat}}</td>
                            <td>{{($refund->quantity*$refund->unit_price)+($refund->quantity*$refund->unit_price)*($refund->vat/100) }}</td>
                            <td>
                                <a href="{{url('refund/delete/'.$refund->id)}}" title="delete">
                                    <i style="color: red" class="flaticon-delete"></i>
                                </a> </td>
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
