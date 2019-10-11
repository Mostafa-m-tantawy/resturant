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

                            <a href="{{route('expenses.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                <th>id</th>
                <th>restaurant</th>
                <th>method</th>
                <th>amount</th>
                <th>due date</th>
                <th>note</th>
                <th>created_at</th>
            </tr>
            </thead>
            <tbody>
           @foreach($expenses as $expense)
               <tr>
                    <td>{{$expense->id}}</td>
                    <td>{{$expense->restaurant->user->name}}</td>
                    <td>{{$expense->payment_method}}</td>
                    <td>{{$expense->payment_amount}}</td>
                    <td>{{$expense->due_date}}</td>
                    <td>{{$expense->note}}</td>
                    <td>{{$expense->created_at}}</td>

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
