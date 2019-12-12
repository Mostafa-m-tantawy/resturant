@extends('layouts.app')
@section('head')
    <link href="{{asset('css/demo1/pages/general/login/login-5.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('appcontent')



    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
            <div
                class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile"
                style="background-image: url({{url('/media//bg/bg-3.jpg')}});">
                <div class="kt-login__left">
                    <div class="kt-login__wrapper">
                        <div class="kt-login__content">
                            <a class="kt-login__logo" href="#">
                                <img class="img-fluid" height="200px" src="{{url('media/logos/logohome.png')}}">
                            </a>
                            <h3 class="kt-login__title">JOIN OUR GREAT COMMUNITY</h3>
                            <span class="kt-login__desc">
									The ultimate Bootstrap & Angular 6 admin theme framework for next generation web apps.
								</span>
                            <div class="kt-login__actions">
                                <a href="{{route('register')}}">
                                    <button type="button" id="kt_login_signup" class="btn btn-outline-brand btn-pill">
                                        Get An Account
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-login__divider">
                    <div></div>
                </div>
                <div class="kt-login__right">
                    <div class="row" STYLE="width: 100%">
                        <div class="col-11">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="kt-portlet kt-portlet--height-fluid">

                                        <div class="kt-portlet__body kt-portlet__body--fit-y">
                                            <br>
                                            <br>
                                            <br>
                                            <!--begin::Widget -->
                                            <div class="kt-widget kt-widget--user-profile-4">
                                                <div class="kt-widget__head">
                                                    <div class="kt-widget__media">
                                                      <a href="{{route('dashboard.hr')}}"> <img class="kt-widget__img kt-hidden-"
                                                             src="{{asset('/media/icons/hr.png')}}" alt="image">
                                                      </a>
                                                    </div>
                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__section">
                                                            <a href="{{route('dashboard.hr')}}"
                                                               class="kt-widget__username">
                                                                {{trans('main.human Resources')}}
                                                            </a>

                                                            <div class="kt-portlet__body">
                                                                <div class="tab-content">


                                                                    <div class="tab-pane active"
                                                                         id="kt_widget2_tab1_content">
                                                                        <div class="kt-widget2">
                                                                            <div
                                                                                class="kt-widget2__item kt-widget2__item--primary">
                                                                                <div class="kt-widget2__checkbox">
                                                                                </div>
                                                                                <div class="kt-widget2__info">
                                                                                    <a href="{{route('dashboard.hr')}}"
                                                                                       class="kt-widget2__title">
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                    </a>
                                                                                    <a href="{{url('product')}}"
                                                                                       class="kt-widget2__username">
                                                                                        By Bob Make Metronic Great
                                                                                        Again.Lorem Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet

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

                                            <!--end::Widget -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="kt-portlet kt-portlet--height-fluid">

                                        <div class="kt-portlet__body kt-portlet__body--fit-y">
                                            <br>
                                            <br>
                                            <br>
                                            <!--begin::Widget -->
                                            <div class="kt-widget kt-widget--user-profile-4">
                                                <div class="kt-widget__head">
                                                    <div class="kt-widget__media">
                                                        <a href="{{route('dashboard.stock')}}" >

                                                            <img class="kt-widget__img kt-hidden-"
                                                                 src="{{asset('/media/icons/hr.png')}}" alt="image">
                                                        </a> </div>
                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__section">
                                                            <a href="{{route('dashboard.stock')}}"
                                                               class="kt-widget__username">
                                                                {{trans('main.Stock Management')}}
                                                            </a>

                                                            <div class="kt-portlet__body">
                                                                <div class="tab-content">


                                                                    <div class="tab-pane active"
                                                                         id="kt_widget2_tab1_content">
                                                                        <div class="kt-widget2">
                                                                            <div
                                                                                class="kt-widget2__item kt-widget2__item--primary">
                                                                                <div class="kt-widget2__checkbox">
                                                                                </div>
                                                                                <div class="kt-widget2__info">
                                                                                    <a href="{{route('dashboard.stock')}}"
                                                                                       class="kt-widget2__title">
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                    </a>
                                                                                    <a href="{{route('dashboard.stock')}}"
                                                                                       class="kt-widget2__username">
                                                                                        By Bob Make Metronic Great
                                                                                        Again.Lorem Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet

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

                                            <!--end::Widget -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="kt-portlet kt-portlet--height-fluid">

                                        <div class="kt-portlet__body kt-portlet__body--fit-y">
                                            <br>
                                            <br>
                                            <br>
                                            <!--begin::Widget -->
                                            <div class="kt-widget kt-widget--user-profile-4">
                                                <div class="kt-widget__head">
                                                    <div class="kt-widget__media">
                                                        <a href="{{route('dashboard.cost')}}" >

                                                         <img class="kt-widget__img kt-hidden-"
                                                             src="{{asset('/media/icons/hr.png')}}" alt="image">
                                                        </a>
                                                    </div>
                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__section">
                                                            <a href="{{route('dashboard.cost')}}" class="kt-widget__username">
                                                                {{trans('main.cost management')}}
                                                            </a>

                                                            <div class="kt-portlet__body">
                                                                <div class="tab-content">


                                                                    <div class="tab-pane active"
                                                                         id="kt_widget2_tab1_content">
                                                                        <div class="kt-widget2">
                                                                            <div
                                                                                class="kt-widget2__item kt-widget2__item--primary">
                                                                                <div class="kt-widget2__checkbox">
                                                                                </div>
                                                                                <div class="kt-widget2__info">
                                                                                    <a href="{{route('dashboard.cost')}}"
                                                                                       class="kt-widget2__title">
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                    </a>
                                                                                    <a href="{{route('dashboard.cost')}}"
                                                                                       class="kt-widget2__username">
                                                                                        By Bob Make Metronic Great
                                                                                     Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet

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

                                            <!--end::Widget -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="kt-portlet kt-portlet--height-fluid">

                                        <div class="kt-portlet__body kt-portlet__body--fit-y">
                                            <br>
                                            <br>
                                            <br>
                                            <!--begin::Widget -->
                                            <div class="kt-widget kt-widget--user-profile-4">
                                                <div class="kt-widget__head">
                                                    <div class="kt-widget__media">
                                                        <a href="{{route('dashboard.pos')}}" >

                                                            <img class="kt-widget__img kt-hidden-"
                                                                 src="{{asset('/media/icons/hr.png')}}" alt="image">
                                                        </a>

                                                    </div>
                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__section">
                                                            <a href="#" class="kt-widget__username">
                                                                {{trans('main.point of sales')}}
                                                            </a>

                                                            <div class="kt-portlet__body">
                                                                <div class="tab-content">


                                                                    <div class="tab-pane active"
                                                                         id="kt_widget2_tab1_content">
                                                                        <div class="kt-widget2">
                                                                            <div
                                                                                class="kt-widget2__item kt-widget2__item--primary">
                                                                                <div class="kt-widget2__checkbox">
                                                                                </div>
                                                                                <div class="kt-widget2__info">
                                                                                    <a href="{{route('dashboard.pos')}}"
                                                                                       class="kt-widget2__title">
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                    </a>
                                                                                    <a href="{{route('dashboard.pos')}}"
                                                                                       class="kt-widget2__username">
                                                                                        By Bob Make Metronic Great
                                                                                        Again.Lorem Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet

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

                                            <!--end::Widget -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="kt-portlet kt-portlet--height-fluid">

                                        <div class="kt-portlet__body kt-portlet__body--fit-y">
                                            <br>
                                            <br>
                                            <br>
                                            <!--begin::Widget -->
                                            <div class="kt-widget kt-widget--user-profile-4">
                                                <div class="kt-widget__head">
                                                    <div class="kt-widget__media">
                                                        <a href="{{route('system-conf.index')}}" >

                                                            <img class="kt-widget__img kt-hidden-"
                                                                 src="{{asset('/media/icons/hr.png')}}" alt="image">
                                                        </a>

                                                    </div>
                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__section">
                                                            <a href="{{route('system-conf.index')}}" class="kt-widget__username">
                                                                {{trans('main.configration')}}
                                                            </a>

                                                            <div class="kt-portlet__body">
                                                                <div class="tab-content">


                                                                    <div class="tab-pane active"
                                                                         id="kt_widget2_tab1_content">
                                                                        <div class="kt-widget2">
                                                                            <div
                                                                                class="kt-widget2__item kt-widget2__item--primary">
                                                                                <div class="kt-widget2__checkbox">
                                                                                </div>
                                                                                <div class="kt-widget2__info">
                                                                                    <a href="{{route('system-conf.index')}}"
                                                                                       class="kt-widget2__title">
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                    </a>
                                                                                    <a href="{{route('system-conf.index')}}"
                                                                                       class="kt-widget2__username">
                                                                                        By Bob Make Metronic Great
                                                                                        Again.Lorem Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet
                                                                                        Make Metronic Great Again.Lorem
                                                                                        Ipsum Amet

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

                                            <!--end::Widget -->
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


@endsection

