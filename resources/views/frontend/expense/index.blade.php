@extends('layouts.welcome')

@section('title')
    {{trans('main.index expense')}}
@stop


@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
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
                        {{trans('main.all')}} {{trans('main.expenses')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{route('expenses.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                {{trans('main.new')}} {{trans('main.record')}}
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
                <th>{{trans('main.id')}}</th>
                <th>{{trans('main.restaurant')}}</th>
                <th>{{trans('main.method')}}</th>
                <th>{{trans('main.amount')}}</th>
                <th>{{trans('main.Due Date')}}</th>
                <th>{{trans('main.note')}}</th>
                <th> {{ trans('main.attachments') }}</th>
                <th>{{trans('main.created_at')}}</th>
                <th>{{trans('main.delete')}}</th>
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
                   <td>
                       @foreach($expense->files as $file)
                           <a title="Show" href="{{url('/download?url='.$file->url)}}">
                               {{$loop->index + 1}}<i class="fa fa-cloud-download-alt"></i></a>
                       @endforeach

                   </td>
                    <td>{{$expense->created_at}}</td>
                   <td>
                           <form method="post"  onsubmit="deleteConfirm(event,'{{trans('main.expenses')}}')"
                                 action="{{route('expenses.destroy',[$expense->id])}}">
                               @csrf
                               @method('DELETE')
                               <button class="btn btn-danger"> {{trans('main.delete')}}</button>
                           </form>
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
