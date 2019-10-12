@extends('layouts.app')
@section('head')
    <link href="{{asset('css/demo1/pages/general/login/login-5.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('appcontent')



    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile"
                 style="background-image: url(/media//bg/bg-3.jpg);">
                <div class="kt-login__left">
                    <div class="kt-login__wrapper">
                        <div class="kt-login__content">
                            <a class="kt-login__logo" href="#">
                                <img src="/media/logos/logo-5.png">
                            </a>
                            <h3 class="kt-login__title">JOIN OUR GREAT COMMUNITY</h3>
                            <span class="kt-login__desc">
									The ultimate Bootstrap & Angular 6 admin theme framework for next generation web apps.
								</span>
                            <div class="kt-login__actions">
                                <button type="button" id="kt_login_signup" class="btn btn-outline-brand btn-pill">Get An Account</button>
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
                                <h3 class="kt-login__title">Login To Your Account</h3>
                            </div>
                            <div class="kt-login__form">
                                <form class="kt-form" action="">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Username" name="username" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form-control-last" type="Password" placeholder="Password" name="password">
                                    </div>
                                    <div class="row kt-login__extra">
                                        <div class="col kt-align-left">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember"> Remember me
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col kt-align-right">
                                            <a href="javascript:;" id="kt_login_forgot" class="kt-link">Forget Password ?</a>
                                        </div>
                                    </div>
                                    <div class="kt-login__actions">
                                        <button id="kt_login_signin_submit" class="btn btn-brand btn-pill btn-elevate">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="kt-login__forgot">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Forgotten Password ?</h3>
                                <div class="kt-login__desc">Enter your email to reset your password:</div>
                            </div>
                            <div class="kt-login__form">
                                <form class="kt-form" action="">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                                    </div>
                                    <div class="kt-login__actions">
                                        <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
                                        <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
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
