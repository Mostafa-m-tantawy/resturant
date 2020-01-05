@extends('layouts.welcome')


@section('title')
    {{trans('main.index supplier')}}
@stop



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
                        {{trans('main.all')}} {{trans('main.supplier')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{route('supplier.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.record')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    <div class="kt-portlet__body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
        <!--begin: Datatable -->
        <table id="datatable-responsive"
               class="display table table-striped table-bordered " cellspacing="0"
               style="width:100%"> <thead>
            <tr>
                <th> {{trans('main.id')}}</th>
                <th>{{trans('main.name')}}</th>
                <th>{{trans('main.email')}}</th>
                <th>{{trans('main.products')}}</th>
                <th>{{trans('main.profile')}}</th>
                <th>{{trans('main.Delete')}}</th>
            </tr>
            </thead>
            <tbody>
           @foreach($suppliers as $supplier)
               <tr>
                    <td>{{$supplier->id}}</td>
                    <td>{{$supplier->user->name}}</td>
                    <td>{{$supplier->user->email}}</td>
                   <td>
                       <a href="{{url('stock/product/create/'.$supplier->id)}}"
                          title="products">
                           <span>{{trans('main.products')}}</span>
                           <i  class="la la-edit" style="font-size: 25px;"></i>
                       </a>
                      </td>
                   <td>
                       <a href="{{route('supplier.show',[$supplier->id])}}" title="profile">
                       <span>{{trans('main.profile')}}</span>
                           <i class="socicon-persona"style=" padding:5px; top:10px;font-size: 25px;">
                           </i>
                       </a>
                   </td>
                   <td>
                  @if($supplier->canDeleted)
                           <form method="post"  onsubmit="deleteConfirm(event,'{{trans('main.supplier')}}')"
                             action="{{route('supplier.destroy',[$supplier->id])}}">
                           @csrf
                           @method('DELETE')
                           <button class="btn btn-danger"> {{trans('main.delete')}}</button>
                       </form>
                       @endif
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
