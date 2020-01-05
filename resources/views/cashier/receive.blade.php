@extends('layouts.welcome')


@section('title')
    {{trans('main.transfer received')}}
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
                        {{trans('main.receives')}}
                    </h3>
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
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>{{trans('main.id')}}</th>
                        <th>{{trans('main.requester')}}</th>
                        <th>{{trans('main.receiver')}} </th>
                        <th>{{trans('main.amount')}}</th>
                        <th>{{trans('main.note')}}</th>
                        <th>{{trans('main.status')}}</th>
                        <th>{{trans('main.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($receives as $receive)
                        {{----}}
                        <tr>
                            <td>{{$receive->id}}</td>
                            <td>{{$receive->sender->name}}</td>
                            <td>{{$receive->receiver->name}}</td>
                            <td>{{$receive->amount}}</td>
                            <td>{{$receive->note}}</td>
                            <td>{{$receive->status }}</td>
                            <td>
                                @if($receive->status != 'pending')
                                    {{trans('main.No action')}}
                                @else
                                    <form method="post"
                                          action="{{route('cashier.storeApprove',[$receive->id])}}">
                                        @csrf
                                        <input  type="submit" value="approved" name="status" class="btn btn-primary">
                                        <input  type="submit" value="rejected"  name="status" class="btn btn-danger">
                                    </form>
                                @endif
                            </td>
                            {{----}}
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
        </div>

    </div>

 @stop
@section('scripts')
@stop
