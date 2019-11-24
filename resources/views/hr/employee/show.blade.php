@extends('layouts.welcome')
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
                                    {{trans('main.employee')}}
                                </h3>
                            </div>

                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.name')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$employee->name}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.email')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$employee->user->email}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.Date of Birth')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$employee->date_of_birth}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.date of joining')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$employee->date_of_joining}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.basic salary')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$employee->salary}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.bank name')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$employee->bank_name}}</span>
                                    </div>
                                </div>

                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.bank account')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$employee->user->email}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.department')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{($employee->department)?$employee->department->name:''}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">{{trans('main.gender')}}:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">  {{trans('main.'.$employee->gender)}} </span>
                                    </div>
                                </div>


                                @foreach($employee->user->phones as $phone)
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

                                @foreach($employee->user->addresses as $address)
                                    <div class="form-group form-group-xs row">
                                        <label class="col-3 col-form-label"> {{trans('main.address')}}{{$loop->index+1}}
                                            :</label>
                                        <div class="col-7">
                                        <span class="form-control-plaintext kt-font-bolder">
                                            {{$address->address}} / {{($address->city)?$address->city->name:''}}</span>
                                        </div>
                                        <div class="col-1">
                                            <a data-toggle="modal" data-target=".delete"
                                               data-model_type="address" data-model_id="{{$address->id}}"><i
                                                    style="color: red" class="flaticon-delete"></i></a>
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
                                            <i class="flaticon2-user-outline-symbol"></i> {{trans('main.emergency')}}
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
                                          action="{{route('employee.update',$employee->id)}}">
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
                                                                   placeholder="Enter full name"
                                                                   value="{{$employee->name}}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="">{{trans('main.email')}}:</label>
                                                            <input type="email" required name="email"
                                                                   value="{{$employee->user->email}}"
                                                                   class="form-control" placeholder="Enter email">
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="">{{trans('main.Date of Birth')}}:</label>
                                                            <input type="date" required name="date_of_birth"
                                                                   value="{{$employee->date_of_birth}}"
                                                                   class="form-control">
                                                        </div>


                                                        <div class="col-12">
                                                            <label class="">{{trans('main.date of joining')}}:</label>
                                                            <input type="date" required name="date_of_joining"
                                                                   value="{{$employee->date_of_joining}}"
                                                                   class="form-control">
                                                        </div>


                                                        <div class="col-12">
                                                            <label class="">{{trans('main.basic salary')}}:</label>
                                                            <input type="number" step="0.01" min="0" name="salary"
                                                                   value="{{$employee->salary}}" class="form-control">
                                                        </div>


                                                        <div class="col-12">
                                                            <label>{{trans('main.bank name')}}:</label>
                                                            <input type="text" name="bank_name"
                                                                   value="{{$employee->bank_name}}"
                                                                   class="form-control">
                                                        </div>


                                                        <div class="col-12">
                                                            <label>{{trans('main.bank account')}}:</label>
                                                            <input type="text" name="bank_account"
                                                                   value="{{$employee->bank_account}}"
                                                                   class="form-control">
                                                        </div>

                                                        <div class="col-12">
                                                            <label>{{trans('main.department')}}:</label>
                                                            <select name="department" id="department"
                                                                    class="form-control">
                                                                <option
                                                                    value="">{{trans('main.select')}} {{trans('main.department')}} </option>
                                                                @foreach($departments as $department)
                                                                    <option
                                                                        value="{{$department->id}}">{{$department->name}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>  {{trans('main.gender')}}</label>
                                                            <div class="form-group row">
                                                                <div class="col-9">
                                                                    <div class="kt-radio-inline">
                                                                        <label class="kt-radio">
                                                                            <input type="radio" value="male"
                                                                                   @if($employee->gender=='male') checked="checked"
                                                                                   @endif name="gender">
                                                                            {{trans('main.male')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="kt-radio">
                                                                            <input type="radio" value="female"
                                                                                   @if($employee->gender=='female') checked="checked"
                                                                                   @endif name="gender">
                                                                            {{trans('main.female')}}
                                                                            <span></span>
                                                                        </label>


                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="kt_repeater_1">
                                                    <h3>{{trans('main.contact')}} {{trans('main.information')}}<a
                                                            href="javascript:;"
                                                            data-repeater-create=""
                                                            class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> {{trans('main.add')}}
                                                        </a></h3>
                                                    <div class="repeater" class="form-group  row">
                                                        <div data-repeater-list="phone_g" class="col-lg-12">
                                                            <br>
                                                            @foreach($employee->user->phones as $phone)
                                                                <div class="form-group form-group-xs row">
                                                                    <label class="col-3 col-form-label">{{$phone->type}}
                                                                        :</label>
                                                                    <div class="col-7">
                                                                        <span
                                                                            class="form-control-plaintext kt-font-bolder">{{$phone->phone}}</span>
                                                                    </div>
                                                                    <div class="col-1"><a
                                                                            data-toggle="modal" data-target=".delete"
                                                                            data-model_type="phone"
                                                                            data-model_id="{{$phone->id}}"><i
                                                                                style="color: red"
                                                                                class="flaticon-delete"></i></a>
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
                                                            @endforeach <br>
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
                                                    <h3>{{trans('main.addresses')}} {{trans('main.information')}}<a
                                                            href="javascript:;"
                                                            data-repeater-create=""
                                                            class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> {{trans('main.add')}}
                                                        </a></h3>
                                                    <br>
                                                    @foreach($employee->user->addresses as $address)
                                                        <div class="form-group form-group-xs row">
                                                            <label class="col-3 col-form-label">
                                                                {{trans('main.address')}}{{$loop->index+1}}:</label>
                                                            <div class="col-7">
                                                                        <span
                                                                            class="form-control-plaintext kt-font-bolder">
                                                              {{   $address->address}} / {{($address->city)?$address->city->name:''}}</span>
                                                            </div>
                                                            <div class="col-1">
                                                                <a data-toggle="modal" data-target=".delete"
                                                                   data-model_type="address"
                                                                   data-model_id="{{$address->id}}"><i
                                                                        style="color: red"
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
                                                                            <option
                                                                                value="00"> {{trans('main.select')}} {{trans('main.country')}}
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
                                                                            <option
                                                                                value="00">{{trans('main.select')}} {{trans('main.city')}}</option>

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
                                                        <button type="submit"
                                                                class="btn btn-primary">{{trans('main.submit')}}</button>
                                                        <button type="reset"
                                                                class="btn btn-secondary">{{trans('main.cancel')}}</button>
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

                                    <form class="kt-form kt-form--label-right" method="post"
                                          action="{{route('emergency.store')}}">
                                        @csrf

                                        <input type="hidden" name="hr_employee_id" value="{{$employee->id}}">
                                        <div class="kt-portlet__body" style="padding: unset">
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

                                                        <br>
                                                        <div class="form-group form-group-xs row">
                                                            @foreach($employee->emergencies as $emergency)

                                                                <div class="col-6">
                                                                    <div class="row">
                                                                        <label
                                                                            class="col-6 col-form-label">{{trans('main.name')}}
                                                                            :</label>
                                                                        <div class="col-6">
                                                                                <span
                                                                                    class="form-control-plaintext kt-font-bolder">{{$emergency->name}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">

                                                                <div class="row">
                                                                        <label
                                                                            class="col-6 col-form-label">{{trans('main.phone')}}
                                                                            :</label>
                                                                        <div class="col-6">
                                                                                <span
                                                                                    class="form-control-plaintext kt-font-bolder">{{$emergency->phone}}</span>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-6">

                                                                <div class="row">
                                                                        <label
                                                                            class="col-6 col-form-label">{{trans('main.address')}}
                                                                            :</label>
                                                                        <div class="col-6">
                                                                                <span
                                                                                    class="form-control-plaintext kt-font-bolder">{{$emergency->address}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">

                                                                    <div class="row">
                                                                        <label
                                                                            class="col-6 col-form-label">{{trans('main.relationship')}}
                                                                            :</label>
                                                                        <div class="col-6">
                                                                                <span
                                                                                    class="form-control-plaintext kt-font-bolder">{{$emergency->relationship}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">

                                                                    <div class="row">
                                                                        <label
                                                                            class="col-6 ">{{trans('main.email')}}
                                                                            :</label>
                                                                        <div class="col-6">
                                                                                <span
                                                                                    class="form-control-plaintext kt-font-bolder">{{$emergency->email}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
<div class="row">

                                                                    <div class="col-6"><a
                                                                            data-toggle="modal"
                                                                            data-target=".delete_emergency"
                                                                            data-id="{{$emergency->id}}"
                                                                            data-name="{{$emergency->id}}"><i
                                                                                style="color: red"
                                                                                class="flaticon-delete"></i></a>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <a data-toggle="modal"
                                                                           data-target=".update_emergency"
                                                                           data-id="{{$emergency->id}}"
                                                                           data-name="{{$emergency->name}}"
                                                                           data-email="{{$emergency->email}}"
                                                                           data-phone="{{$emergency->phone}}"
                                                                           data-address="{{$emergency->address}}"
                                                                           data-relationship="{{$emergency->relationship}}"><i
                                                                                class="flaticon-edit-1"></i></a>
                                                                    </div>
                                                                </div>
                                                                </div>

                                                            @endforeach
                                                        </div>

                                                        <br>
                                                        <br>
                                                        <div  class="row kt-margin-b-10">


                                                            <div class="col-6">
                                                                <label>{{trans('main.name')}}:</label>
                                                                <input type="text" required name="name"
                                                                       class="form-control"
                                                                       placeholder="Enter full name">
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="">{{trans('main.email')}}:</label>
                                                                <input type="email" required name="email"
                                                                       class="form-control"
                                                                       placeholder="Enter email">
                                                            </div>


                                                            <div class="col-6">
                                                                <label>{{trans('main.phone')}}:</label>
                                                                <input type="text" name="phone"
                                                                       class="form-control">
                                                            </div>


                                                            <div class="col-6">
                                                                <label>{{trans('main.address')}}:</label>
                                                                <input type="text" name="address"
                                                                       class="form-control">
                                                            </div>

                                                            <div class="col-6">
                                                                <label>{{trans('main.relationship')}}:</label>
                                                                <input type="text" name="relationship"
                                                                       class="form-control">
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
                                                        <button type="submit"
                                                                class="btn btn-primary">{{trans('main.submit')}}</button>
                                                        <button type="reset"
                                                                class="btn btn-secondary">{{trans('main.cancel')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>

                <!--End:: Portlet-->
            </div>


        </div>
    </div>









    @include('.frontend.modals.update-address')
    @include('.frontend.modals.update-phone')
    @include('.frontend.modals.delete')
    @include('.hr.modals.delete_emergency')
    @include('.hr.modals.update_emergency')






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

            $('#department').val('{{$employee->department_id}}');


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


            $('#update_emergency').on('show.bs.modal', function (e) {

                var Id = $(e.relatedTarget).data('id');
                var phone = $(e.relatedTarget).data('phone');
                var address = $(e.relatedTarget).data('address');
                var name = $(e.relatedTarget).data('name');
                var email = $(e.relatedTarget).data('email');
                var relationship = $(e.relatedTarget).data('relationship');
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('input[name="phone"]').val(phone);
                $(e.currentTarget).find('input[name="address"]').val(address);
                $(e.currentTarget).find('input[name="name"]').val(name);
                $(e.currentTarget).find('input[name="email"]').val(email);
                $(e.currentTarget).find('input[name="relationship"]').val(relationship);
                $(e.currentTarget).find('form').attr('action', "{{url('emergency/')}}/" + Id);
            });


            $('#delete_emergency').on('show.bs.modal', function (e) {
                var Id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');
                $(e.currentTarget).find('.name').html(name);
                $(e.currentTarget).find('input[name="id"]').val(Id);
                $(e.currentTarget).find('form').attr('action', "{{url('emergency/')}}/" + Id);

            });


        })
    </script>

@stop
