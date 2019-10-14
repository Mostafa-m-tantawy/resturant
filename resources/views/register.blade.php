@extends('layouts.app')
@section('head')
    <link href="{{asset('/css/demo1/pages/general/login/login-3.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('appcontent')


    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
             style="background-image: url({{url('media/bg/bg-3.jpg')}});">
            <div class="kt-login__container">

                <br>
                <br>
                <div class="row">
                    <div class="col-12" style=" text-align: center; padding: 10px;">
                        <div class="kt-login__logo">
                            <a href="{{url('/')}}">
                                <img class="img-fluid" style="height: 200px" src="{{url('media/logos/logohome.png')}}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-1" ></div>

                    <div class="col-10" style="  padding: 50px;">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="kt-login__signup">
                            <form class="kt-form kt-form--label-right" method="post" action="{{route('restaurant.store')}}">
                                @csrf
                                <div class="kt-portlet__body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Personal Information</h3>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Full Name:</label>
                                                    <input type="text" required name="name" class="form-control"
                                                           placeholder="Enter full name">
                                                    <span
                                                        class="form-text text-muted">Please enter Restaurant full name</span>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="">Email:</label>
                                                    <input type="email" required name="email" class="form-control"
                                                           placeholder="Enter email">
                                                    <span class="form-text text-muted">Please enter your email</span>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Password :</label>
                                                    <input type="password" required name="password" class="form-control"
                                                           placeholder="********">
                                                    <span class="form-text text-muted">Please enter password</span>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Password :</label>
                                                    <input type="password" required name="password_confirmation" class="form-control"
                                                           placeholder="********">
                                                    <span class="form-text text-muted">Please enter password</span>
                                                </div>

                                            </div>
                                        </div>
                                            <div class="col-md-6">
                                                <div class="row">
{{--                                                    <div class="col-md-12">--}}
{{--                                                       </div>--}}
                                                <div class="col-md-12" id="kt_repeater_1">
                                                    <h3>Contact    <a href="javascript:;"
                                                                                 style="clear: both"
                                                                                 data-repeater-create=""
                                                                                 class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> Add
                                                        </a></h3>

                                                    <div class="repeater" class="form-group  row">

                                                        <div data-repeater-list="phone_g" class="col-lg-12">
                                                            <div data-repeater-item class="row kt-margin-b-10">
                                                                <div class="col-lg-5">
                                                                    <label>Phone</label>

                                                                    <div class="input-group">

                                                                        <input type="text"
                                                                               class="form-control form-control-danger"
                                                                               name="phone"
                                                                               placeholder="012**********">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label>Type</label>

                                                                    <div class=" form-group input-group">

                                                                        <input type="text"
                                                                               class="form-control form-control-danger"
                                                                               name="type"
                                                                               placeholder="Ex: office">
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

                                                <div class="col-md-12" id="kt_repeater_2" class="repeater">
                                                    <h3>Addresses
                                                        <a href="javascript:;"   style="clear: both"
                                                           data-repeater-create=""
                                                           class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> Add
                                                        </a></h3>
                                                    <div data-repeater-list="address_g">
                                                        <div class="form-group form-group-last row" data-repeater-item>

                                                            <div class="col-lg-12">
                                                                <label>Address:</label>
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input type="text" name="address"
                                                                           class="form-control"
                                                                            placeholder="Enter your address">
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                                                class="la la-map-marker"></i></span></span>
                                                                </div>
                                                                <span
                                                                    class="form-text text-muted">Please enter your address</span>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="row kt-margin-b-10">
                                                                    <div class="col-lg-5">
                                                                        <label>Country</label>
                                                                        <select class="form-control country"
                                                                                name="country"
                                                                                onchange="changecity(this)">
                                                                            <option value="00">Select Country</option>
                                                                            @foreach($countries as $country)
                                                                                <option
                                                                                    value="{{$country->id}}">{{$country->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <label>City</label>

                                                                        <select class="form-control" name="city">
                                                                            <option value="00">Select City</option>

                                                                        </select>
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
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row kt-login__extra">
                                    <div class="col kt-align-left">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="agree">I Agree the <a href="#"
                                                                                               class="kt-link kt-login__link kt-font-bold">terms
                                                and conditions</a>.
                                            <span></span>
                                        </label>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_signup_submit"
                                            class="btn btn-brand btn-elevate kt-login__btn-primary">Sign Up
                                    </button>&nbsp;&nbsp;
                                    <button id="kt_login_signup_cancel"
                                            class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-1" ></div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')


    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
    <script>

        function changecity(select){


            $.ajax('{{url('/')}}/states',{
                method:'post',
                data:{_token:'{{@csrf_token()}}',id:$(select).val()},
                dataType:'JSON',
                success:function(data){
                    // $('#cityoption').html('');
                    // console.log(  $(select).parent().parent().find(' .col-lg-5:nth-child(2) select ').html('ssssss'));
                    $(select).parent().parent().find(' .col-lg-5:nth-child(2) select').empty();

                    for (var i=0;i<data.length;i++){
                        $(select).parent().parent().find(' .col-lg-5:nth-child(2) select').append('           ' +
                            '<option value="'+data[i].id+'">'+data[i].name+'</option>');
                    }
                },
                error:function() {
                    alert('There is an error  exist make sure you are  log in ');
                }
            });
        }

    </script>
@stop
