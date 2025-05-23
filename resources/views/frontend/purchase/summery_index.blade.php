@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('title')
    {{trans('main.purchase summery')}}
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

                            <a href="{{url('stock/purchase/create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                       class="display table table-striped table-bordered " cellspacing="0"
                       style="width:100%">         <thead>
                    <tr>
                        <th>  {{ trans('main.id') }}</th>
                        <th> {{ trans('main.supplier') }} </th>
                        <th>  {{ trans('main.total') }}</th>
                        <th> {{ trans('main.action') }}</th>
                        <th> {{ trans('main.attachments') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purses as $purchase)
                        <tr>
                            <td>{{$purchase->id}}</td>
                            <td>{{$purchase->supplier->user->name}}</td>
                            <td>{{$purchase->total}}</td>

                            <td>
                                <a title="Show" href="{{url('stock/purchase/show/'.$purchase->id)}}"> <i  class="fa fa-book-open"></i></a>
                            </td>

                            <td>
                               @foreach($purchase->files as $file)
                                    <a title="Show" href="{{url('/download?url='.$file->url)}}">
                                        {{$loop->index + 1}}<i class="fa fa-cloud-download-alt"></i></a>
                                @endforeach

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























