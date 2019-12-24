@extends('layouts.welcome')


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
                        {{trans('main.requests')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="#"  data-toggle="modal" data-target="#newunit" class="btn btn-brand btn-elevate btn-icon-sm">
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
                    @foreach($requests as $request)
                        {{----}}
                        <tr>
                            <td>{{$request->id}}</td>
                            <td>{{$request->sender->name}}</td>
                            <td>{{$request->receiver->name}}</td>
                            <td>{{$request->amount}}</td>
                            <td>{{$request->note}}</td>
                            <td>{{trans('main.'.$request->status )}}</td>
                            <td>
                                @if($request->status != 'pending')
                                    {{trans('main.No action')}}
                                @else
                                    <form method="post"  onsubmit="deleteConfirm(event,'{{trans('main.money request')}}')"
                                      action="{{route('cashier.request.destroy',[$request->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"> {{trans('main.delete')}}</button>
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

    <div class="modal fade newunit" id="newunit" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('cashier.storeRequest')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.new')}} {{trans('main.request')}} <span class="model_type"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-1"></div>

                            <div class="col-10">


                                <div class="form-group">
                                    <label>{{trans('main.receiver')}}</label>
                                <select name="receiver" class="form-control">
                                    <option value="">{{trans('main.select')}} {{trans('main.employee')}}</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                               @endforeach

                                </select>
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.amount')}}</label>
                                    <input type="number" step="0.01" min="0" class="form-control" name="amount">
                                </div>

                                <div class="form-group">
                                    <label>{{trans('main.note')}}</label>
                                    <input type="text" class="form-control" name="note">
                                </div>


                            </div>

                            <div class="col-1"></div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.create')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop
