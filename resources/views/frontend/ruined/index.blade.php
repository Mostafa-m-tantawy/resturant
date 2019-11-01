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
                        {{ trans('main.ruineds') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{route('ruined.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{ trans('main.new') }} {{ trans('main.record') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table id="datatable-responsive"
                       class="display table table-striped table-bordered " cellspacing="0"
                       style="width:100%">    <thead>
                    <tr>

                        <th>{{ trans('main.id') }}</th>
                        <th>{{ trans('main.type') }}</th>
                        <th>{{ trans('main.from') }}</th>
                        <th>{{ trans('main.product') }}</th>
                        <th>{{ trans('main.quantity') }}</th>
                        <th>{{ trans('main.unit price') }}</th>
                        <th>{{ trans('main.gross') }}</th>
                        <th>{{ trans('main.note') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ruineds as $ruin)
                        <tr>
                            <td>{{$ruin->id}}</td>
                            <td>{{($ruin->ruinedHeader->ruinedable_type=='App\Restaurant')?
                            trans('main.restaurant'):trans('main.department')}}</td>
                            <td>{{($ruin->ruinedHeader->ruinedable_type=='App\Restaurant')?
                            $ruin->ruinedHeader->ruinedable->user->name:
                             $ruin->ruinedHeader->ruinedable->name}}</td>
                            <td>{{$ruin->product->name}}</td>
                            <td>{{$ruin->quantity}}</td>
                            <td>{{$ruin->price_unit}}</td>
                            <td>{{($ruin->quantity*$ruin->price_unit)}}</td>
                            <td>{{$ruin->note}}</td>

{{--                             <td>--}}
{{--                                <a href="{{url('refund/delete/'.$refund->id)}}" title="delete">--}}
{{--                                    <i style="color: red" class="flaticon-delete"></i>--}}
{{--                                </a> </td>--}}
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>

        </div>
    </div>

@stop
