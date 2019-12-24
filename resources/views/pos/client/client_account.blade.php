@extends('.pos.layout.pos_app')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>

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
                        {{trans('main.clients')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="#" data-toggle="modal" data-target="#newLeaveType"
                               class="btn btn-brand btn-elevate btn-icon-sm">
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
                <div class="row">
                <div class="col-6">
                    <h1>{{trans('main.Deposits')}}</h1>
                    <!--begin: Datatable -->
                    <table id="datatable-responsive"
                           class="display table table-striped table-bordered " cellspacing="0"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>{{trans('main.id')}}</th>
                            <th>{{trans('main.method')}}</th>
                            <th>{{trans('main.amount')}}</th>
                            <th>{{trans('main.created_at')}} </th>
                            <th>{{trans('main.delete')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->method}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->created_at}}</td>

                                <td>
                                    <form method="post" onsubmit="deleteConfirm(event,'{{trans('main.payment')}}')"
                                          action="{{route('client-account.destroy',[$payment->id])}}">
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
                    <div class="col-6">
                        <h1>{{trans('main.payments')}}</h1>

                        <!--begin: Datatable -->
                        <table id="datatable-responsive"
                               class="display table table-striped table-bordered " cellspacing="0"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>{{trans('main.id')}}</th>
                                <th>{{trans('main.order')}}</th>
                                <th>{{trans('main.amount')}}</th>
                                <th>{{trans('main.created_at')}} </th>
                                <th>{{trans('main.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderPayments as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->order_id}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->created_at}}</td>
                                    <td>
                                        <form method="post" onsubmit="deleteConfirm(event,'{{trans('main.payment')}}')"
                                              action="{{route('client-account.destroy',[$payment->id])}}">
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
        </div>

    </div>

    <div class="modal fade newLeaveType" id="newLeaveType" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('client-account.store')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{trans('main.new Deposit')}} <span
                                class="model_type"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-1"></div>

                            <div class="col-10">
                                <input type="hidden"   name="client_id"
                                       class="form-control" value="{{$client->id}}" >

                                <div class="form-group ">
                                    <label for="inputPassword4"
                                           class="control-label">{{trans('main.payment method')}}</label>
                                    <select class="form-control" id="payment_method" name="payment_method">
                                        <option value="cash">{{ trans('main.select') }} {{ trans('main.payment') }} </option>
                                        <option value="cash">{{ trans('main.cash') }} </option>
                                        <option value="check">{{ trans('main.check') }} </option>
                                        <option value="creditcard">{{ trans('main.creditcard') }} </option>
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label
                                        class=" control-label">  {{ trans('main.amount') }}</label>
                                    <input type="text"  required name="amount"
                                           class="form-control" id="easy-numpad-output" >

                                </div>
                                <div class="form-group">
                                    <label class=" control-label">{{ trans('main.note') }}</label>
                                    <input type="text" name="note" class="form-control" id="note">

                                </div>
                                <div class="form-group">
                                    <label class=control-label">{{ trans('main.files') }} :</label>
                                    <input type="file" name="files[]" multiple class="form-control">
                                </div>
                            </div>

                            <div class="col-1"></div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit"
                                    class="btn btn-brand btn-elevate btn-icon-sm">{{trans('main.create')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
@section('scripts')

@stop
