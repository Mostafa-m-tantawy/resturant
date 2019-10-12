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

                            <a href="{{route('restaurant.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>profile</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if($mainRestaurant)
                        <tr>
                            <td>{{$mainRestaurant->id}}</td>
                            <td>{{$mainRestaurant->user->name}}</td>
                            <td>{{$mainRestaurant->user->email}}</td>
                            <td>Main Office</td>
                            <td>
                                <a href="{{url('restaurant/'.$mainRestaurant->id)}}" title="profile">
                                    <span>Profile</span>
                                    <i class="socicon-persona" style=" padding:5px; top:10px;font-size: 25px;"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                    @foreach($branches as $branche)
                        <tr>
                            <td>{{$branche->id}}</td>
                            <td>{{$branche->user->name}}</td>
                            <td>{{$branche->user->email}}</td>
                            <td>Branch</td>
                            <td>
                                <a href="{{url('restaurant/'.$branche->id)}}" title="profile">
                                    <span>Profile</span>
                                    <i class="socicon-persona" style=" padding:5px; top:10px;font-size: 25px;"></i>
                                </a>
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
                    'copy', 'excel', 'pdf', 'print'
                ],
            });
        })
    </script>

@stop
