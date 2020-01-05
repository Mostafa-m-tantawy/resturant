@extends('layouts.welcome')


@section('title')
    {{trans('main.show supplier')}}
@stop



@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">



        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="row">
                <div class="col-xl-4">


                    <!--Begin:: Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{trans('main.supplier')}}
                                </h3>
                            </div>

                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.name')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$supplier->user->name}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.email')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$supplier->user->email}}</span>
                                    </div>
                                </div>

                                @foreach($supplier->user->phones as $phone)
                                    <div class="form-group form-group-xs row">
                                        <label class="col-3 col-form-label">{{$phone->type}}:</label>
                                        <div class="col-7">
                                            <span class="form-control-plaintext kt-font-bolder">{{$phone->phone}}</span>
                                        </div>
                                        <div class="col-1">
                                            <a data-toggle="modal" data-target=".delete"
                                               data-model_type="phone" data-model_id="{{$phone->id}}">
                                                <i style="color: red" class="flaticon-delete"></i></a>
                                        </div>
                                        <div class="col-1">
                                            <a data-toggle="modal" data-target=".update_phone"
                                               data-id="{{$phone->id}}" data-phone="{{$phone->phone}}"
                                               data-type="{{$phone->type}}"><i class="flaticon-edit-1"></i></a>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach($supplier->user->addresses as $address)
                                    <div class="form-group form-group-xs row">
                                        <label class="col-3 col-form-label"> {{trans('main.address')}}{{$loop->index+1}}:</label>
                                        <div class="col-7">
                                        <span class="form-control-plaintext kt-font-bolder">
                                            {{$address->address}} / {{($address->city)?$address->city->name:''}}</span>
                                        </div>
                                        <div class="col-1">
                                            <a data-toggle="modal" data-target=".delete"
                                               data-model_type="address" data-model_id="{{$address->id}}"><i style="color: red" class="flaticon-delete"></i></a>
                                        </div>
                                        <div class="col-1">
                                            <a data-toggle="modal" data-target=".update_address"
                                               data-id="{{$address->id}}" data-address="{{$address->address}}"><i
                                                    class="flaticon-edit-1"></i></a>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                        </div>
                    </div>

                    <!--End:: Portlet-->




                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{trans('main.financial')}} {{trans('main.receivables')}}
                                </h3>
                            </div>

                        </div>  <div class="kt-portlet__body">
                            <div class="kt-widget1 kt-widget1--fit">
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{trans('main.Starting Balance')}}</h3>
                                        <span class="kt-widget1__desc">{{trans('main.Supplier starting balance')}} </span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-brand">+${{number_format($supplier->start_balance,2)}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{trans('main.purchases')}}</h3>
                                        <span class="kt-widget1__desc">{{trans('main.Restaurant gross  purchases')}}</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-brand">+${{number_format($supplier->GrossPurchases,2)}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{trans('main.refunds')}}  </h3>
                                        <span class="kt-widget1__desc">{{trans('main.Restaurant gross return to supplier')}} </span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-danger">-${{number_format($supplier->GrossRefunds,2)}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{trans('main.payment')}}</h3>
                                        <span class="kt-widget1__desc">{{trans('main.Restaurant gross payment')}}</span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-danger">-${{number_format($supplier->GrossPayments,2)}}</span>
                                </div>
                                <div class="kt-widget1__item">
                                    <div class="kt-widget1__info">
                                        <h3 class="kt-widget1__title">{{trans('main.dept')}}</h3>
                                        <span class="kt-widget1__desc">{{trans('main.restaurant')}} {{trans('main.dept')}}  </span>
                                    </div>
                                    <span class="kt-widget1__number kt-font-success">${{number_format($supplier->start_balance+$supplier->GrossPurchases-$supplier->GrossRefunds-$supplier->GrossPayments,2)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-8">

                    <!--Begin:: Portlet-->
                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                                    role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_3"
                                           role="tab">
                                            <i class="flaticon2-calendar-3"></i> {{trans('main.personal')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_supplier_purchases"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> {{trans('main.purchases')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_supplier_payments"
                                           role="tab">
                                            <i class="flaticon2-gear"></i> {{trans('main.payments')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content kt-margin-t-20">

                                    <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane active" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                                    <form class="kt-form kt-form--label-right" method="post"
                                          action="{{route('supplier.update',$supplier->id)}}">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <h3>{{trans('main.personal')}} {{trans('main.information')}}</h3>
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label>{{trans('main.name')}}:</label>
                                                            <input type="text" required name="name" class="form-control"
                                                                   placeholder="Enter full name" value="{{$supplier->user->name}}">
                                                            </div>
                                                        <div class="col-12">
                                                            <label class="">{{trans('main.email')}}:</label>
                                                            <input type="email" required name="email"
                                                                   value="{{$supplier->user->email}}" class="form-control" placeholder="Enter email">
                                                         </div>
                                                        <div class="col-12">

                                                            <label>{{trans('main.Starting Balance')}} :</label>
                                                            <input type="number" step='0.01' name="balance"
                                                                   value="{{$supplier->start_balance}}"class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="kt_repeater_1">
                                                    <h3>{{trans('main.contact')}} {{trans('main.information')}}<a href="javascript:;"
                                                                              data-repeater-create=""
                                                                              class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> {{trans('main.add')}}
                                                        </a></h3>
                                                    <div class="repeater" class="form-group  row">
                                                        <div data-repeater-list="phone_g" class="col-lg-12">
                                                            <br>
                                                            @foreach($supplier->user->phones as $phone)
                                                                <div class="form-group form-group-xs row">
                                                                    <label class="col-3 col-form-label">{{$phone->type}}:</label>
                                                                    <div class="col-7">
                                                                        <span class="form-control-plaintext kt-font-bolder">{{$phone->phone}}</span>
                                                                    </div>
                                                                    <div class="col-1"><a
                                                                            data-toggle="modal" data-target=".delete"
                                                                            data-model_type="phone" data-model_id="{{$phone->id}}"><i style="color: red" class="flaticon-delete"></i></a>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <a data-toggle="modal"
                                                                           data-target=".update_phone"
                                                                           data-id="{{$phone->id}}"
                                                                           data-phone="{{$phone->phone}}"
                                                                           data-type="{{$phone->type}}"><i
                                                                                class="flaticon-edit-1"></i></a>
                                                                    </div>
                                                                </div>
                                                            @endforeach                                                             <br>
                                                            <br>
                                                            <div data-repeater-item class="row kt-margin-b-10">





                                                                <div class="col-lg-5">
                                                                    <label>{{trans('main.phone')}}</label>

                                                                    <div class="input-group">

                                                                        <input type="text" required
                                                                               class="form-control form-control-danger"
                                                                               name="phone" placeholder="012**********">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label>{{trans('main.type')}}</label>

                                                                    <div class=" form-group input-group">

                                                                        <input type="text" required
                                                                               class="form-control form-control-danger"
                                                                               name="type" placeholder="Ex: office">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2" style=" display: flex;
  justify-content: center;
  align-items: center">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                       class="btn btn-danger btn-icon">
                                                                        <i class="la la-remove"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-6" id="kt_repeater_2" class="repeater">
                                                    <h3>{{trans('main.addresses')}} {{trans('main.information')}}<a href="javascript:;"
                                                                                data-repeater-create=""
                                                                                class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> {{trans('main.add')}}
                                                        </a></h3>
                                                    <br>
                                                    @foreach($supplier->user->addresses as $address)
                                                        <div class="form-group form-group-xs row">
                                                            <label class="col-3 col-form-label">
                                                                {{trans('main.address')}}{{$loop->index+1}}:</label>
                                                            <div class="col-7">
                                                                        <span class="form-control-plaintext kt-font-bolder">
                                                              {{   $address->address}} / {{($address->city)?$address->city->name:''}}</span>
                                                            </div>
                                                            <div class="col-1">
                                                                <a data-toggle="modal" data-target=".delete"
                                                                   data-model_type="address" data-model_id="{{$address->id}}"><i style="color: red"
                                                                      class="flaticon-delete"></i></a>
                                                            </div>
                                                            <div class="col-1">
                                                                <a data-toggle="modal"
                                                                   data-target=".update_address"
                                                                   data-id="{{$address->id}}"
                                                                   data-address="{{$address->address}}"><i
                                                                        class="flaticon-edit-1"></i></a>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <br>

                                                    <div data-repeater-list="address_g">
                                                        <div class="form-group form-group-last row" data-repeater-item>
                                                                <div class="col-lg-12">
                                                                    <label>{{trans('main.address')}}:</label>
                                                                    <div class="kt-input-icon kt-input-icon--right">
                                                                        <input type="text" name="address"
                                                                               class="form-control"
                                                                               required
                                                                               placeholder="{{trans('main.enter')}} {{trans('main.address')}} ">
                                                                        <span
                                                                            class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                                                    class="la la-map-marker"></i></span></span>
                                                                    </div>
                                                                    </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row kt-margin-b-10">
                                                                        <div class="col-lg-5">
                                                                            <label>{{trans('main.country')}}</label>
                                                                            <select class="form-control country"
                                                                                    name="country"
                                                                                    onchange="changecity(this)">
                                                                                <option value="00"> {{trans('main.select')}} {{trans('main.country')}}
                                                                                </option>
                                                                                @foreach($countries as $country)
                                                                                    <option
                                                                                        value="{{$country->id}}">{{$country->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <label>{{trans('main.city')}}</label>

                                                                            <select class="form-control" name="city">
                                                                                <option value="00">{{trans('main.select')}} {{trans('main.city')}}</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-2" style=" display: flex;
  justify-content: center;
  align-items: center">
                                                                            <a href="javascript:;"
                                                                               data-repeater-delete=""
                                                                               class="btn btn-danger btn-icon">
                                                                                <i class="la la-remove"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8">
                                                        <button type="submit" class="btn btn-primary">{{trans('main.submit')}}</button>
                                                        <button type="reset" class="btn btn-secondary">{{trans('main.cancel')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!--End:: Tab Content-->

                                <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_supplier_purchases" role="tabpanel">

                                    <div class="kt-portlet__body" style="padding: unset">

                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('main.restaurant')}} {{trans('main.purchases')}}
                                                </h3>
                                            </div>
                                            <div class="kt-portlet__head-toolbar">
                                                <div class="kt-portlet__head-wrapper">
                                                    <div class="kt-portlet__head-actions">

                                                        <a href="{{url('stock/purchase/create')}}"
                                                           class="btn btn-brand btn-elevate btn-icon-sm">
                                                            <i class="la la-plus"></i>
                                                            {{trans('main.new')}} {{trans('main.purchases')}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin: Datatable -->
                                       <table id="datatable-responsive"
                                               class="display table table-striped table-bordered " cellspacing="0"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{trans('main.id')}}</th>
                                                <th>{{trans('main.supplier')}}</th>
                                                <th>{{trans('main.total')}} {{trans('main.price')}}</th>
                                                <th>{{trans('main.action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($supplier->purchases as $purchase)
                                                <tr>
                                                    <td>{{$purchase->id}}</td>
                                                    <td>{{$purchase->supplier->user->name}}</td>
                                                    <td>{{$purchase->total}}</td>

                                                    <td>
                                                        <a title="Show" href="{{url('stock/purchase/show/'.$purchase->id)}}">
                                                            <i class="fa fa-book-open"></i></a>

                                                        {{--                                <a title="delete" href="{{url('product/delete/'.$product->id)}}"> <i style="color: red"--}}
                                                        {{--                                                                                                     class="flaticon-delete"></i></a>--}}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!--End:: Tab Content--> <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_supplier_payments" role="tabpanel">

                                    <div class="kt-portlet__body" style="padding: unset">

                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('main.restaurant')}} {{trans('main.payments')}}
                                                </h3>
                                            </div>
                                            <div class="kt-portlet__head-toolbar">
                                                <div class="kt-portlet__head-wrapper">
                                                    <div class="kt-portlet__head-actions">

                                                        <a href="{{route('payment.create')}}"
                                                           class="btn btn-brand btn-elevate btn-icon-sm"
                                                           data-toggle="modal" data-target=".new_payment"><i
                                                                class="la la-plus"></i>
                                                            {{trans('main.new')}} {{trans('main.payment')}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin: Datatable -->
                                         <table id="datatable-responsive"
                                               class="display table table-striped table-bordered " cellspacing="0"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th> {{trans('main.id')}}</th>
                                                <th>{{trans('main.amount')}}</th>
                                                <th>{{trans('main.method')}}</th>
                                                <th>{{trans('main.Due Date')}}</th>
                                                <th>{{ trans('main.attachments') }}</th>
                                                <th>{{trans('main.action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($supplier->payment as $payment)


                                                <tr>
                                                    <td>{{$payment->id}}</td>
                                                    <td>{{$payment->payment_amount}}</td>
                                                    <td>{{$payment->payment_method}}</td>
                                                    <td>{{$payment->due_date}}</td>
                                                    <td>
                                                        @foreach($purchase->files as $file)
                                                            <a title="Show" href="{{url('/download?url='.$file->url)}}">
                                                                {{$loop->index + 1}}<i class="fa fa-cloud-download-alt"></i></a>
                                                        @endforeach

                                                    </td> <td><a title="delete"
                                                           href="{{url('stock/purchase/delete/'.$payment->id)}}">
                                                            <i style="color: red" class="flaticon-delete"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{--                {{dd($products)}}--}}


                                            </tbody>
                                        </table>

                                    </div>


                                    <div
                                        class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>

                                    <div class="kt-form__actions">

                                    </div>
                                    </form>
                                </div>

                                <!--End:: Tab Content-->
                            </div>
                        </div>
                    </div>

                    <!--End:: Portlet-->
                </div>


            </div>
        </div>

        <!-- end:: Content -->
    </div>






    <div class="modal fade new_payment" id="updatemodel" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('payment.create')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('main.payment')}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="container">

                            <div class="row">
                                <div class="form-group col-12">
                                    <label for=""
                                           class=" control-label"> {{ trans('main.current') }}  {{ trans('main.due') }}</label>
                                    <input type="text" value="{{number_format($supplier->start_balance+$supplier->GrossPurchases-$supplier->GrossRefunds-$supplier->GrossPayments,2)}}" readonly class="form-control" id="currentDue">
                                    <div>
                                        <input type="hidden" name="sender_id" value="{{Auth::user()->restaurant->id}}">
                                        <input type="hidden" name="receiver_id" value="{{$supplier->id}}">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label for="inputPassword4"
                                           class="control-label">{{ trans('main.payment') }} {{ trans('main.method') }}</label>

                                    <select class="form-control" id="payment_method"
                                            name="payment_method">
                                        <option value="cash">{{ trans('main.cash') }} </option>
                                        <option value="check">{{ trans('main.check') }} </option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label
                                        class=" control-label">  {{ trans('main.payment') }}
                                        :</label>
                                    <input type="number" min="0" required name="payment"
                                           class="form-control"
                                           id="payment" value="" step="0.01">

                                </div>
                                <div class="form-group col-12">
                                    <label
                                        class=" control-label">  {{ trans('main.note') }}
                                        :</label>
                                    <input type="text" name="note"
                                           class="form-control" id="note">

                                </div>
                                <div class="form-group col-12">
                                    <label class=control-label">{{ trans('main.files') }} :</label>
                                    <input type="file" name="files[]" multiple class="form-control">


                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">{{ trans('main.pay') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



    @include('.frontend.modals.update-address')
    @include('.frontend.modals.update-phone')
    @include('.frontend.modals.delete')






@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>

    <script>
        function changecity(select) {


            $.ajax('{{url('/')}}/states', {
                method: 'post',
                data: {_token: '{{@csrf_token()}}', id: $(select).val()},
                dataType: 'JSON',
                success: function (data) {
                    // $('#cityoption').html('');
                    // console.log(  $(select).parent().parent().find(' .col-lg-5:nth-child(2) select ').html('ssssss'));
                    $(select).parent().parent().find(' .col-lg-5:nth-child(2) select').empty()
                    for (var i = 0; i < data.length; i++) {
                        $(select).parent().parent().find(' .col-lg-5:nth-child(2) select').append('           ' +
                            '<option value="' + data[i].id + '">' + data[i].name + '</option>');
                    }
                },
                error: function () {
                    alert('There is an error  exist make sure you are  log in ');
                }
            });
        }

        $.fn.dataTableExt.ofnSearch['html-input'] = function (value) {
            return $(value).val();
        };
        $(document).ready(function () {
            $('#delete').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('model_id');
                var type = $(e.relatedTarget).data('model_type');
                $(e.currentTarget).find('.model_type').html(type);
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="type"]').val(type);
            });

            $('#update_address').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var address = $(e.relatedTarget).data('address');

                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="address"]').val(address);
            });
            $('#update_phone').on('show.bs.modal', function (e) {

                var Id = $(e.relatedTarget).data('id');
                var phone = $(e.relatedTarget).data('phone');
                var type = $(e.relatedTarget).data('type');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="phone"]').val(phone);
                $(e.currentTarget).find('input[name="type"]').val(type);
            });



        })
    </script>

@stop
