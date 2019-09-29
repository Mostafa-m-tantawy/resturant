@extends('layouts.welcome')
@section('head')
    <link href="{{asset('vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('header')
    {{--    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">--}}
    {{--        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">--}}
    {{--            <ul class="kt-menu__nav ">--}}
    {{--                <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Pages</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>--}}
    {{--                    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">--}}
    {{--                        <ul class="kt-menu__subnav">--}}
    {{--                            <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="demo1/index.html" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">--}}
    {{--																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
    {{--																	<rect id="bound" x="0" y="0" width="24" height="24" />--}}
    {{--																	<path d="M5.84026576,8 L18.1597342,8 C19.1999115,8 20.0664437,8.79732479 20.1528258,9.83390904 L20.8194924,17.833909 C20.9112219,18.9346631 20.0932459,19.901362 18.9924919,19.9930915 C18.9372479,19.9976952 18.8818364,20 18.8264009,20 L5.1735991,20 C4.0690296,20 3.1735991,19.1045695 3.1735991,18 C3.1735991,17.9445645 3.17590391,17.889153 3.18050758,17.833909 L3.84717425,9.83390904 C3.93355627,8.79732479 4.80008849,8 5.84026576,8 Z M10.5,10 C10.2238576,10 10,10.2238576 10,10.5 L10,11.5 C10,11.7761424 10.2238576,12 10.5,12 L13.5,12 C13.7761424,12 14,11.7761424 14,11.5 L14,10.5 C14,10.2238576 13.7761424,10 13.5,10 L10.5,10 Z" id="Combined-Shape" fill="#000000" />--}}
    {{--																	<path d="M10,8 L8,8 L8,7 C8,5.34314575 9.34314575,4 11,4 L13,4 C14.6568542,4 16,5.34314575 16,7 L16,8 L14,8 L14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 C10.4477153,6 10,6.44771525 10,7 L10,8 Z" id="Path-53" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
    {{--																</g>--}}
    {{--															</svg></span><span class="kt-menu__link-text">My Account</span></a></li>--}}
    {{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">--}}
    {{--																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
    {{--																	<rect id="bound" x="0" y="0" width="24" height="24" />--}}
    {{--																	<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />--}}
    {{--																	<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000" />--}}
    {{--																</g>--}}
    {{--															</svg></span><span class="kt-menu__link-text">Task Manager</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--success">2</span></span></a></li>--}}
    {{--                            <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">--}}
    {{--																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
    {{--																	<rect id="bound" x="0" y="0" width="24" height="24" />--}}
    {{--																	<path d="M9,15 L7.5,15 C6.67157288,15 6,15.6715729 6,16.5 C6,17.3284271 6.67157288,18 7.5,18 C8.32842712,18 9,17.3284271 9,16.5 L9,15 Z M9,15 L9,9 L15,9 L15,15 L9,15 Z M15,16.5 C15,17.3284271 15.6715729,18 16.5,18 C17.3284271,18 18,17.3284271 18,16.5 C18,15.6715729 17.3284271,15 16.5,15 L15,15 L15,16.5 Z M16.5,9 C17.3284271,9 18,8.32842712 18,7.5 C18,6.67157288 17.3284271,6 16.5,6 C15.6715729,6 15,6.67157288 15,7.5 L15,9 L16.5,9 Z M9,7.5 C9,6.67157288 8.32842712,6 7.5,6 C6.67157288,6 6,6.67157288 6,7.5 C6,8.32842712 6.67157288,9 7.5,9 L9,9 L9,7.5 Z M11,13 L13,13 L13,11 L11,11 L11,13 Z M13,11 L13,7.5 C13,5.56700338 14.5670034,4 16.5,4 C18.4329966,4 20,5.56700338 20,7.5 C20,9.43299662 18.4329966,11 16.5,11 L13,11 Z M16.5,13 C18.4329966,13 20,14.5670034 20,16.5 C20,18.4329966 18.4329966,20 16.5,20 C14.5670034,20 13,18.4329966 13,16.5 L13,13 L16.5,13 Z M11,16.5 C11,18.4329966 9.43299662,20 7.5,20 C5.56700338,20 4,18.4329966 4,16.5 C4,14.5670034 5.56700338,13 7.5,13 L11,13 L11,16.5 Z M7.5,11 C5.56700338,11 4,9.43299662 4,7.5 C4,5.56700338 5.56700338,4 7.5,4 C9.43299662,4 11,5.56700338 11,7.5 L11,11 L7.5,11 Z" id="Path-2" fill="#000000" fill-rule="nonzero" />--}}
    {{--																</g>--}}
    {{--															</svg></span><span class="kt-menu__link-text">Team Manager</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>--}}
    {{--                                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">--}}
    {{--                                    <ul class="kt-menu__subnav">--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Add Team Member</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Edit Team Member</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Delete Team Member</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Team Member Reports</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Assign Tasks</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Promote Team Member</span></a></li>--}}
    {{--                                    </ul>--}}
    {{--                                </div>--}}
    {{--                            </li>--}}
    {{--                            <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="#" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">--}}
    {{--																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
    {{--																	<rect id="bound" x="0" y="0" width="24" height="24" />--}}
    {{--																	<path d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L4,21 C2.8954305,21 2,20.1045695 2,19 L2,15 L6.27924078,15 L6.82339262,16.6324555 C7.09562072,17.4491398 7.8598984,18 8.72075922,18 L15.381966,18 C16.1395101,18 16.8320364,17.5719952 17.1708204,16.8944272 L18.118034,15 L22,15 Z" id="Combined-Shape" fill="#000000" />--}}
    {{--																	<path d="M2.5625,13 L5.92654389,7.01947752 C6.2807805,6.38972356 6.94714834,6 7.66969497,6 L16.330305,6 C17.0528517,6 17.7192195,6.38972356 18.0734561,7.01947752 L21.4375,13 L18.118034,13 C17.3604899,13 16.6679636,13.4280048 16.3291796,14.1055728 L15.381966,16 L8.72075922,16 L8.17660738,14.3675445 C7.90437928,13.5508602 7.1401016,13 6.27924078,13 L2.5625,13 Z" id="Path" fill="#000000" opacity="0.3" />--}}
    {{--																</g>--}}
    {{--															</svg></span><span class="kt-menu__link-text">Projects Manager</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>--}}
    {{--                                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">--}}
    {{--                                    <ul class="kt-menu__subnav">--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Latest Projects</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Ongoing Projects</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Urgent Projects</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Completed Projects</span></a></li>--}}
    {{--                                        <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Dropped Projects</span></a></li>--}}
    {{--                                    </ul>--}}
    {{--                                </div>--}}
    {{--                            </li>--}}
    {{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="javascript:;" class="kt-menu__link "><span class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">--}}
    {{--																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
    {{--																	<rect id="bound" x="0" y="0" width="24" height="24" />--}}
    {{--																	<path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z M10.5857864,14 L9.17157288,15.4142136 C8.78104858,15.8047379 8.78104858,16.4379028 9.17157288,16.8284271 C9.56209717,17.2189514 10.1952621,17.2189514 10.5857864,16.8284271 L12,15.4142136 L13.4142136,16.8284271 C13.8047379,17.2189514 14.4379028,17.2189514 14.8284271,16.8284271 C15.2189514,16.4379028 15.2189514,15.8047379 14.8284271,15.4142136 L13.4142136,14 L14.8284271,12.5857864 C15.2189514,12.1952621 15.2189514,11.5620972 14.8284271,11.1715729 C14.4379028,10.7810486 13.8047379,10.7810486 13.4142136,11.1715729 L12,12.5857864 L10.5857864,11.1715729 C10.1952621,10.7810486 9.56209717,10.7810486 9.17157288,11.1715729 C8.78104858,11.5620972 8.78104858,12.1952621 9.17157288,12.5857864 L10.5857864,14 Z" id="Combined-Shape" fill="#000000" />--}}
    {{--																</g>--}}
    {{--															</svg></span><span class="kt-menu__link-text">Create New Project</span></a></li>--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                </li>--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@stop
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    View Contact
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <div class="kt-subheader__group" id="kt_subheader_search">
									<span class="kt-subheader__desc" id="kt_subheader_total">
										Sandra Stone </span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="#" class="btn btn-default btn-bold">
                    Back </a>
            </div>
        </div>

        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

            <div class="row">
                <div class="col-xl-4">


                    <!--Begin:: Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Supplier
                                </h3>
                            </div>

                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">Name:</label>
                                    <div class="col-7">
                                        <span
                                            class="form-control-plaintext kt-font-bolder">{{$supplier->user->name}}</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-3 col-form-label">email:</label>
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
                                            <a><i style="color: red" class="flaticon-delete"></i></a>
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
                                        <label class="col-3 col-form-label"> Address{{$loop->index+1}}:</label>
                                        <div class="col-7">
                                        <span class="form-control-plaintext kt-font-bolder">
                                            {{$address->address}} / {{($address->city)?$address->city->name:''}}</span>
                                        </div>
                                        <div class="col-1">
                                            <a><i style="color: red" class="flaticon-delete"></i></a>
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
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1"
                                           role="tab">
                                            <i class="flaticon2-note"></i> Notes
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2"
                                           role="tab">
                                            <i class="flaticon2-time"></i> Activities
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3"
                                           role="tab">
                                            <i class="flaticon2-calendar-3"></i> Personal
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_supplier_purchases"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> Purchases
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_supplier_payments"
                                           role="tab">
                                            <i class="flaticon2-gear"></i> Payments
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content kt-margin-t-20">

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                    <form>
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleTextarea" rows="3"
                                                      placeholder="Type notes"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <a href="#" class="btn btn-label-brand btn-bold">Add notes</a>
                                                <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
                                    <div class="kt-notes kt-scroll kt-scroll--pull" data-scroll="true"
                                         style="height: 700px;">
                                        <div class="kt-notes__items">
                                            <div class="kt-notes__item">
                                                <div class="kt-notes__media">
                                                    <img class="kt-hidden-" src="./assets/media/users/100_3.jpg"
                                                         alt="image">
                                                    <span class="kt-notes__icon kt-font-boldest kt-hidden">
																		<i class="flaticon2-cup"></i>
																	</span>
                                                    <h3 class="kt-notes__user kt-font-boldest kt-hidden">
                                                        N S
                                                    </h3>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                New order
                                                            </a>
                                                            <span class="kt-notes__desc">
																				9:30AM 16 June, 2015
																			</span>
                                                            <span class="kt-badge kt-badge--success kt-badge--inline">new</span>
                                                        </div>
                                                        <div class="kt-notes__dropdown">
                                                            <a href="#" class="btn btn-sm btn-icon-md btn-icon"
                                                               data-toggle="dropdown">
                                                                <i class="flaticon-more-1 kt-font-brand"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="kt-nav">
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Reports</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Charts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Members</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Settings</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
																	</span>
                                                </div>
                                            </div>
                                            <div class="kt-notes__item">
                                                <div class="kt-notes__media">
																	<span class="kt-notes__icon">
																		<i class="flaticon2-rocket kt-font-danger"></i>
																	</span>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                Notification
                                                            </a>
                                                            <span class="kt-notes__desc">
																				10:30AM 23 May, 2013
																			</span>
                                                        </div>
                                                        <div class="kt-notes__dropdown">
                                                            <a href="#" class="btn btn-sm btn-icon-md btn-icon"
                                                               data-toggle="dropdown">
                                                                <i class="flaticon2-rectangular kt-font-brand"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="kt-nav">
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Reports</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Charts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Members</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Settings</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
																	</span>
                                                </div>
                                            </div>
                                            <div class="kt-notes__item">
                                                <div class="kt-notes__media">
                                                    <h3 class="kt-notes__user kt-font-brand kt-font-boldest">
                                                        DS
                                                    </h3>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                System alert
                                                            </a>
                                                            <span class="kt-notes__desc">
																				7:10AM 21 February, 2016
																			</span>
                                                        </div>
                                                        <div class="kt-notes__dropdown">
                                                            <a href="#" class="btn btn-sm btn-icon-md btn-icon"
                                                               data-toggle="dropdown">
                                                                <i class="flaticon2-note kt-font-brand"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="kt-nav">
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Reports</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Charts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Members</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Settings</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
																	</span>
                                                </div>
                                            </div>
                                            <div class="kt-notes__item">
                                                <div class="kt-notes__media">
																	<span class="kt-notes__icon">
																		<i class="flaticon2-poll-symbol kt-font-success"></i>
																	</span>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                New order
                                                            </a>
                                                            <span class="kt-notes__desc">
																				10:30AM 23 May, 2013
																			</span>
                                                        </div>
                                                        <div class="kt-notes__dropdown">
                                                            <a href="#" class="btn btn-sm btn-icon-md btn-icon"
                                                               data-toggle="dropdown">
                                                                <i class="flaticon2-gear kt-font-brand"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="kt-nav">
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Reports</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Charts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Members</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Settings</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
																	</span>
                                                </div>
                                            </div>
                                            <div class="kt-notes__item">
                                                <div class="kt-notes__media">
																	<span class="kt-notes__icon">
																		<i class="flaticon2-box-1 kt-font-brand"></i>
																	</span>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                Notification
                                                            </a>
                                                            <span class="kt-notes__desc">
																				10:30AM 23 May, 2013
																			</span>
                                                        </div>
                                                        <div class="kt-notes__dropdown">
                                                            <a href="#" class="btn btn-sm btn-icon-md btn-icon"
                                                               data-toggle="dropdown">
                                                                <i class="flaticon2-sort kt-font-brand"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="kt-nav">
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Reports</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Charts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Members</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Settings</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
																	</span>
                                                </div>
                                            </div>
                                            <div class="kt-notes__item">
                                                <div class="kt-notes__media">
																	<span class="kt-notes__icon">
																		<i class="flaticon2-rocket kt-font-danger"></i>
																	</span>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                Notification
                                                            </a>
                                                            <span class="kt-notes__desc">
																				10:30AM 23 May, 2013
																			</span>
                                                        </div>
                                                        <div class="kt-notes__dropdown">
                                                            <a href="#" class="btn btn-sm btn-icon-md btn-icon"
                                                               data-toggle="dropdown">
                                                                <i class="flaticon2-rectangular kt-font-brand"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="kt-nav">
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Reports</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Messages</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Charts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Members</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="kt-nav__item">
                                                                        <a href="#" class="kt-nav__link">
                                                                            <i class="kt-nav__link-icon flaticon2-settings"></i>
                                                                            <span
                                                                                class="kt-nav__link-text">Settings</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut perspiciatis unde omnis iste natus error sit voluptatem, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
																	</span>
                                                </div>
                                            </div>
                                            <div class="kt-notes__item kt-notes__item--clean">
                                                <div class="kt-notes__media">
                                                    <img class="kt-hidden" src="./assets/media/users/100_1.jpg"
                                                         alt="image">
                                                    <span class="kt-notes__icon kt-font-boldest kt-hidden">
																		<i class="flaticon2-cup"></i>
																	</span>
                                                    <h3 class="kt-notes__user kt-font-boldest kt-hidden">
                                                        M E
                                                    </h3>
                                                    <span class="kt-notes__circle kt-hidden-"></span>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                Order
                                                            </a>
                                                            <span class="kt-notes__desc">
																				11:40AM 14 March, 2012
																			</span>
                                                            <span class="kt-badge kt-badge--danger kt-badge--inline">important</span>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.
																	</span>
                                                </div>
                                            </div>
                                            <div class="kt-notes__item kt-notes__item--clean">
                                                <div class="kt-notes__media">
                                                    <img class="kt-hidden" src="./assets/media/users/100_1.jpg"
                                                         alt="image">
                                                    <span class="kt-notes__icon kt-font-boldest kt-hidden">
																		<i class="flaticon2-cup"></i>
																	</span>
                                                    <h3 class="kt-notes__user kt-font-boldest kt-hidden">
                                                        N B
                                                    </h3>
                                                    <span class="kt-notes__circle kt-hidden-"></span>
                                                </div>
                                                <div class="kt-notes__content">
                                                    <div class="kt-notes__section">
                                                        <div class="kt-notes__info">
                                                            <a href="#" class="kt-notes__title">
                                                                Remarks
                                                            </a>
                                                            <span class="kt-notes__desc">
																				10:30AM 23 April, 2013
																			</span>
                                                        </div>
                                                    </div>
                                                    <span class="kt-notes__body">
																		Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.
																	</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                                    <div class="kt-notification">
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                            id="Combined-Shape" fill="#000000"/>
                                                        <rect id="Rectangle-Copy-2" fill="#000000" opacity="0.3"
                                                              transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "
                                                              x="16.3255682" y="2.94551858" width="3" height="18"
                                                              rx="1"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    New order has been received.
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    2 hrs ago
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z"
                                                            id="Combined-Shape" fill="#000000"/>
                                                        <path
                                                            d="M8.4472136,18.1055728 C8.94119209,18.3525621 9.14141644,18.9532351 8.89442719,19.4472136 C8.64743794,19.9411921 8.0467649,20.1414164 7.5527864,19.8944272 L5,18.618034 L5,14.5 C5,13.9477153 5.44771525,13.5 6,13.5 C6.55228475,13.5 7,13.9477153 7,14.5 L7,17.381966 L8.4472136,18.1055728 Z"
                                                            id="Path-85" fill="#000000" fill-rule="nonzero"
                                                            opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    New member is registered and pending for approval.
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    3 hrs ago
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                            id="Combined-Shape" fill="#000000" fill-rule="nonzero"
                                                            opacity="0.3"/>
                                                        <circle id="Oval-14" fill="#000000" cx="12" cy="9" r="5"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    Membership application has been added.
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    3 hrs ago
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon id="Bound" points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M18.5,8 C17.1192881,8 16,6.88071187 16,5.5 C16,4.11928813 17.1192881,3 18.5,3 C19.8807119,3 21,4.11928813 21,5.5 C21,6.88071187 19.8807119,8 18.5,8 Z M18.5,21 C17.1192881,21 16,19.8807119 16,18.5 C16,17.1192881 17.1192881,16 18.5,16 C19.8807119,16 21,17.1192881 21,18.5 C21,19.8807119 19.8807119,21 18.5,21 Z M5.5,21 C4.11928813,21 3,19.8807119 3,18.5 C3,17.1192881 4.11928813,16 5.5,16 C6.88071187,16 8,17.1192881 8,18.5 C8,19.8807119 6.88071187,21 5.5,21 Z"
                                                            id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                                        <path
                                                            d="M5.5,8 C4.11928813,8 3,6.88071187 3,5.5 C3,4.11928813 4.11928813,3 5.5,3 C6.88071187,3 8,4.11928813 8,5.5 C8,6.88071187 6.88071187,8 5.5,8 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 C14,5.55228475 13.5522847,6 13,6 L11,6 C10.4477153,6 10,5.55228475 10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,18 L13,18 C13.5522847,18 14,18.4477153 14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 C10,18.4477153 10.4477153,18 11,18 Z M5,10 C5.55228475,10 6,10.4477153 6,11 L6,13 C6,13.5522847 5.55228475,14 5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 C18.4477153,14 18,13.5522847 18,13 L18,11 C18,10.4477153 18.4477153,10 19,10 Z"
                                                            id="Combined-Shape" fill="#000000"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    New report file has been uploaded.
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    5 hrs ago
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="Rectangle-10" x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z"
                                                            id="Path-3" fill="#000000"/>
                                                        <path
                                                            d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z"
                                                            id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    New user feedback received and pending for review.
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    8 hrs ago
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="kt-svg-icon kt-svg-icon--brand">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                            id="Combined-Shape" fill="#000000"/>
                                                        <circle id="Oval" fill="#000000" opacity="0.3" cx="18.5"
                                                                cy="5.5" r="2.5"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title">
                                                    Database sever #2 has been fully restarted.
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    23 hrs ago
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                                    <form class="kt-form kt-form--label-right" method="post"
                                          action="{{route('supplier.update')}}">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Personal Information</h3>
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <label>Full Name:</label>
                                                            <input type="text" required name="name" class="form-control"
                                                                   placeholder="Enter full name" value="{{$supplier->name}}">
                                                            <span class="form-text text-muted">Please enter your full name</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="">Email:</label>
                                                            <input type="email" required name="email"
                                                                   value="{{$supplier->email}}" class="form-control" placeholder="Enter email">
                                                            <span
                                                                class="form-text text-muted">Please enter your email</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <label>Start Balance :</label>
                                                            <input type="number" step='0.01' name="balance"
                                                                   value="{{$supplier->balance}}"class="form-control">
                                                            <span  class="form-text text-muted">Please enter start balance</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="kt_repeater_1">
                                                    <h3>Contact Information<a href="javascript:;"
                                                                              data-repeater-create=""
                                                                              class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> Add
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
                                                                    <div class="col-1"><a><i style="color: red" class="flaticon-delete"></i></a>
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
                                                                    <label>Phone</label>

                                                                    <div class="input-group">

                                                                        <input type="text" required
                                                                               class="form-control form-control-danger"
                                                                               name="phone" placeholder="012**********">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label>Type</label>

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
                                                    <h3>Addresses Information<a href="javascript:;"
                                                                                data-repeater-create=""
                                                                                class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i> Add
                                                        </a></h3>
                                                    <br>
                                                    @foreach($supplier->user->addresses as $address)
                                                        <div class="form-group form-group-xs row">
                                                            <label class="col-3 col-form-label">
                                                                Address{{$loop->index+1}}:</label>
                                                            <div class="col-7">
                                                                        <span class="form-control-plaintext kt-font-bolder">
                                            {                   {{   $address->address}} / {{($address->city)?$address->city->name:''}}</span>
                                                            </div>
                                                            <div class="col-1">
                                                                <a><i style="color: red"
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
                                                                    <label>Address:</label>
                                                                    <div class="kt-input-icon kt-input-icon--right">
                                                                        <input type="text" name="address"
                                                                               class="form-control"
                                                                               required
                                                                               placeholder="Enter your address">
                                                                        <span
                                                                            class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                                                    class="la la-map-marker"></i></span></span>
                                                                    </div>
                                                                    <span class="form-text text-muted">Please enter your address</span>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row kt-margin-b-10">
                                                                        <div class="col-lg-5">
                                                                            <label>Country</label>
                                                                            <select class="form-control country"
                                                                                    name="country"
                                                                                    onchange="changecity(this)">
                                                                                <option value="00">Select Country
                                                                                </option>
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
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-secondary">Cancel</button>
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
                                                    Multiple Controls
                                                </h3>
                                            </div>
                                            <div class="kt-portlet__head-toolbar">
                                                <div class="kt-portlet__head-wrapper">
                                                    <div class="kt-portlet__head-actions">

                                                        <a href="{{url('purchase')}}"
                                                           class="btn btn-brand btn-elevate btn-icon-sm"
                                                           data-toggle="modal" data-target=".new_payment"><i
                                                                class="la la-plus"></i>
                                                            New Purchase
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin: Datatable -->
                                        <div
                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                        <table id="datatable-responsive"
                                               class="table table-striped table-bordered dt-responsive  nowrap "
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Purchase ID</th>
                                                <th>Restaurant name</th>
                                                <th>Supplier Name</th>
                                                <th>Total price</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($supplier->purchases as $purchase)
                                                <tr>
                                                    <td>{{$purchase->id}}</td>
                                                    <td>{{$purchase->restaurant->user->name}}</td>
                                                    <td>{{$purchase->supplier->user->name}}</td>
                                                    <td>{{$purchase->total}}</td>

                                                    <td>
                                                        <a title="Show" href="{{url('purchase/show/'.$purchase->id)}}">
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
                                                    Multiple Controls
                                                </h3>
                                            </div>
                                            <div class="kt-portlet__head-toolbar">
                                                <div class="kt-portlet__head-wrapper">
                                                    <div class="kt-portlet__head-actions">

                                                        <a href="{{route('payment.create')}}"
                                                           class="btn btn-brand btn-elevate btn-icon-sm"
                                                           data-toggle="modal" data-target=".new_payment"><i
                                                                class="la la-plus"></i>
                                                            New Payment
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin: Datatable -->
                                        <div
                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                        <table id="datatable-responsive"
                                               class="table table-striped table-bordered dt-responsive  nowrap "
                                               cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th> ID</th>
                                                <th>Sender Id</th>
                                                <th>Sender name</th>
                                                <th>amount</th>
                                                <th>method</th>
                                                <th>due date</th>
                                                <th>action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($supplier->payment as $payment)


                                                <tr>
                                                    <td>{{$payment->id}}</td>
                                                    <td>{{$payment->sender->id}}</td>
                                                    <td>{{$payment->sender->name}}</td>
                                                    <td>{{$payment->payment_amount}}</td>
                                                    <td>{{$payment->payment_method}}</td>
                                                    <td>{{$payment->due_date}}</td>
                                                    <td><a title="delete"
                                                           href="{{url('purchase/delete/'.$payment->id)}}">
                                                            <i style="color: red" class="flaticon-delete"></i></a>
                                                    </td>
                                                {{--                                                    --}}{{--                    <td>{{$product->unit->name}}</td>--}}
                                                {{--                                                    <td>1</td>--}}
                                                {{--                                                    <td>{{$payment->barcode}}</td>--}}
                                                {{--                                                    <td>{{$payment->reorder_point}}</td>--}}
                                                {{--                                                    <td>{{$payment->vat}}</td>--}}
                                                {{--                                                    <td>--}}
                                                {{--                                                        <a title="update"--}}
                                                {{--                                                           data-toggle="modal" data-target=".bd-example-modal-lg"--}}
                                                {{--                                                           data-id="{{$product->id}}" data-name="{{$product->name}}"--}}
                                                {{--                                                           data-unit="1"--}}
                                                {{--                                                           data-barcode="{{$product->barcode}}"--}}
                                                {{--                                                           data-vat="{{$product->vat}}"--}}
                                                {{--                                                           data-reorder="{{$product->reorder_point}}"><i--}}
                                                {{--                                                                class="flaticon-edit-1"></i>--}}
                                                {{--                                                        </a>--}}
                                                {{--                                                        <a title="delete"--}}
                                                {{--                                                           href="{{url('product/delete/'.$product->id)}}"> <i--}}
                                                {{--                                                                style="color: red"--}}
                                                {{--                                                                class="flaticon-delete"></i></a>--}}
                                                {{--                                                    </td>--}}

                                                {{--                                                </tr>--}}
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
                <form action="{{url('payment/store')}}" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Product</h5>
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
                                    <div>
                                        {{--                                        <input type="text" readonly class="form-control" id="currentDue">--}}
                                        <input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="receiver_id" value="{{$supplier->user->id}}">
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
                                    <label class=control-label">{{ trans('main.file') }} :</label>
                                    <input type="file" name="file" class="form-control">


                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>























    <div class="modal fade update_phone" id="update_phone" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('phone/update')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Phone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <label>id</label>
                                    <input type="text" readonly class="form-control" name="id">
                                </div>
                                <div class="col-12">
                                    <label>phone</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                                <div class="col-12">

                                    <label>type</label>
                                    <input type="text" class="form-control" name="type">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


















    <div class="modal fade update_address" id="update_address" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{url('address/update')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Update phone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <label>id</label>
                                    <input type="text" readonly class="form-control" name="id">
                                </div>
                                <div class="col-12">
                                    <label>name</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                                <div class="col-lg-12">
                                    <div class="row kt-margin-b-10">
                                        <div class="col-lg-5">
                                            <label>Country</label>
                                            <select class="form-control country" name="country"
                                                    onchange="changecity(this)">
                                                <option value="00">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-5">
                                            <label>City</label>

                                            <select class="form-control" name="city_id">
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
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>











































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


            $("#datatable-responsive").DataTable({
                order: [0, 'desc'],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],

            });
        })
    </script>

@stop
