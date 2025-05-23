@extends('layouts.app')
@section('head')
    <link href="{{asset('css/demo1/pages/general/login/login-5.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('title')
    {{trans('main.login')}}
@stop



@section('appcontent')



    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile"
                 style="background-image: url({{url('/media//bg/bg-3.jpg')}});">
                <div class="kt-login__left">
                    <div class="kt-login__wrapper">
                        <div class="kt-login__content">
                            <a class="kt-login__logo" href="#">
                                <img class="img-fluid" height="200px" src="{{url('media/logos/recipe2.png')}}">
                            </a>
                            <h3 class="kt-login__title">{{trans('main.System that Satisfies your needs.')}}</h3>
                            <span class="kt-login__desc">
                                {{trans('main.Stock Management System , Cost Management System, Hr Management System and Point of sales all together for make it easy for you.' )}}
                            </span>
                            <div class="kt-login__actions">
                                <a href="{{route('register')}}"> <button type="button" id="kt_login_signup" class="btn btn-outline-brand btn-pill">{{trans('main.Get An Account')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-login__divider">
                    <div></div>
                </div>
                <div class="kt-login__right">
                    <div class="kt-login__wrapper">
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">{{trans('main.Login To Your Account')}}</h3>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="kt-login__form">
                                <form class="kt-form" method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control" type="email" required placeholder="{{trans('main.Email')}}" name="email" >
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-last" required type="Password" placeholder="{{trans('main.Password')}}" name="password">
                                    </div>
                                    <div class="row kt-login__extra">
                                        <div class="col kt-align-left">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{trans('main.Remember me')}}
                                                <span></span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="kt-login__actions">
                                        <button id="kt_login_signin_submit" class="btn btn-brand btn-pill btn-elevate">{{trans('main.Sign In')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
