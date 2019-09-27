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

            <!--Begin:: Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">
                            <div class="kt-widget__media">
                                <img src="./assets/media/users/100_12.jpg" alt="image">
                            </div>
                            <div
                                class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-bolder kt-font-light kt-hidden">
                                JM
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <div class="kt-widget__user">
                                        <a href="#" class="kt-widget__username">
                                            David Smith
                                        </a>
                                        <span
                                            class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success">Customer</span>
                                        <div class="dropdown dropdown-inline kt-margin-l-5" data-toggle="kt-tooltip-"
                                             title="Change label" data-placement="right">
                                            <a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                            <div
                                                class="dropdown-menu dropdown-menu-md dropdown-menu-fit dropdown-menu-right">
                                                <ul class="kt-nav">
                                                    <li class="kt-nav__head">
                                                        Choose label:
                                                        <i class="flaticon2-information" data-toggle="kt-tooltip"
                                                           data-placement="right" title="Click to learn more..."></i>
                                                    </li>
                                                    <li class="kt-nav__separator">
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link" data-toggle="status-change"
                                                           data-status="1">
                                                            <span class="kt-nav__link-text"><span
                                                                    class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--lg kt-badge--bold">Customer</span></span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link" data-toggle="status-change"
                                                           data-status="2">
                                                            <span class="kt-nav__link-text"><span
                                                                    class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--lg kt-badge--bold">Partner</span></span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link" data-toggle="status-change"
                                                           data-status="3">
                                                            <span class="kt-nav__link-text"><span
                                                                    class="kt-badge kt-badge--unified-warning kt-badge--inline kt-badge--lg kt-badge--bold">Supplier</span></span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link" data-toggle="status-change"
                                                           data-status="4">
                                                            <span class="kt-nav__link-text"><span
                                                                    class="kt-badge kt-badge--unified-info kt-badge--inline kt-badge--lg kt-badge--bold">On Hold</span></span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link" data-toggle="status-change"
                                                           data-status="4">
                                                            <span class="kt-nav__link-text"><span
                                                                    class="kt-badge kt-badge--unified-brand kt-badge--inline kt-badge--lg kt-badge--bold">Staff</span></span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__separator">
                                                    </li>
                                                    <li class="kt-nav__foot">
                                                        <a class="btn btn-clean btn-bold btn-sm" href="#"><i
                                                                class="flaticon2-add-1 kt-icon-sm"></i> Add new</a>
                                                        <a class="btn btn-clean btn-bold btn-sm kt-hidden" href="#"
                                                           data-toggle="kt-tooltip" data-placement="right"
                                                           title="Click to learn more...">Learn more</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget__action">
                                        <a href="#" class="btn btn-label-brand btn-sm btn-upper">Contact</a>
                                        <div class="dropdown dropdown-inline">
                                            <a href="#" class="btn btn-brand btn-sm btn-upper dropdown-toggle"
                                               data-toggle="dropdown">
                                                Export
                                            </a>
                                            <div
                                                class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">

                                                <!--begin::Nav-->
                                                <ul class="kt-nav">
                                                    <li class="kt-nav__head">
                                                        Export Options
                                                        <i class="flaticon2-information" data-toggle="kt-tooltip"
                                                           data-placement="right" title="Click to learn more..."></i>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                            <span class="kt-nav__link-text">Activity</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                            <span class="kt-nav__link-text">FAQ</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-link"></i>
                                                            <span class="kt-nav__link-text">Settings</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                            <span class="kt-nav__link-text">Support</span>
                                                            <span class="kt-nav__link-badge">
																				<span
                                                                                    class="kt-badge kt-badge--success">5</span>
																			</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__foot">
                                                        <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade
                                                            plan</a>
                                                        <a class="btn btn-clean btn-bold btn-sm" href="#"
                                                           data-toggle="kt-tooltip" data-placement="right"
                                                           title="Click to learn more...">Learn more</a>
                                                    </li>
                                                </ul>

                                                <!--end::Nav-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget__subhead">
                                    <a href="#"><i class="flaticon2-new-email"></i>david.s@loop.com</a>
                                    <a href="#"><i class="flaticon2-calendar-3"></i>PR Manager </a>
                                    <a href="#"><i class="flaticon2-placeholder"></i>Melbourne</a>
                                </div>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__desc">
                                        I distinguish three main text objektive could be merely to inform people.
                                        <br> A second could be persuade people.You want people to bay objective
                                    </div>
                                    <div class="kt-widget__progress">
                                        <div class="kt-widget__text">
                                            Goals
                                        </div>
                                        <div class="progress" style="height: 5px;width: 100%;">
                                            <div class="progress-bar kt-bg-success" role="progressbar"
                                                 style="width: 65%;" aria-valuenow="65" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <div class="kt-widget__stats">
                                            45%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__bottom kt-hidden">
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-piggy-bank"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Earnings</span>
                                    <span class="kt-widget__value"><span>$</span>249,500</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-confetti"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Expances</span>
                                    <span class="kt-widget__value"><span>$</span>164,700</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-pie-chart"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Net</span>
                                    <span class="kt-widget__value"><span>$</span>782,300</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-file-2"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">73 Tasks</span>
                                    <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-chat-1"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">648 Comments</span>
                                    <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-network"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <div class="kt-section__content kt-section__content--solid">
                                        <div class="kt-badge kt-badge__pics">
                                            <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand"
                                               data-placement="top" title="" data-original-title="John Myer">
                                                <img src="./assets/media/users/100_7.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand"
                                               data-placement="top" title="" data-original-title="Alison Brandy">
                                                <img src="./assets/media/users/100_3.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand"
                                               data-placement="top" title="" data-original-title="Selina Cranson">
                                                <img src="./assets/media/users/100_2.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand"
                                               data-placement="top" title="" data-original-title="Luke Walls">
                                                <img src="./assets/media/users/100_13.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand"
                                               data-placement="top" title="" data-original-title="Micheal York">
                                                <img src="./assets/media/users/100_4.jpg" alt="image">
                                            </a>
                                            <a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">
                                                +7
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--End:: Portlet-->
            <div class="row">
                <div class="col-xl-4">

                    <!--Begin:: Portlet-->
                    <div class="kt-portlet kt-portlet--head-noborder">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title  kt-font-danger">
                                    Important Notice
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <span
                                    class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--danger">Now</span>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit-top">
                            <div class="kt-section kt-section--space-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s.
                            </div>
                            <div class="kt-section kt-section--last">
                                <a href="#" class="btn btn-brand btn-sm btn-bold"><i class=""></i> Set up</a>&nbsp;
                                <a href="#" class="btn btn-clean btn-sm btn-bold">Dismiss</a>
                            </div>
                        </div>
                    </div>

                    <!--End:: Portlet-->

                    <!--Begin:: Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Deals
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="#" class="btn btn-clean btn-sm btn-bold" data-toggle="dropdown">
                                    <i class="flaticon2-add-1 kt-icon-sm"></i> Add deal
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">

                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Add new deal
                                            <i class="flaticon2-information" data-toggle="kt-tooltip"
                                               data-placement="right" title="Click to learn more..."></i>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">New Deal</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                <span class="kt-nav__link-text">New Lead</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-link"></i>
                                                <span class="kt-nav__link-text">Change Settings</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                                <span class="kt-nav__link-badge">
																	<span class="kt-badge kt-badge--success">5</span>
																</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__foot">
                                            <a class="btn btn-label-danger btn-bold btn-sm" href="#">Manage deals</a>
                                            <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip"
                                               data-placement="right" title="Click to learn more...">Learn more</a>
                                        </li>
                                    </ul>

                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--space-md">
                                <div class="kt-widget24 kt-widget24--solid">
                                    <div class="kt-widget24__details">
                                        <div class="kt-widget24__info">
                                            <a href="#" class="kt-widget24__title" title="Click to edit">
                                                Hardware Purchase
                                            </a>
                                            <span class="kt-widget24__desc">
																Web & database servers
															</span>
                                        </div>
                                        <span class="kt-widget24__stats kt-font-brand">
															$340,050
														</span>
                                    </div>
                                    <div class="progress progress--sm">
                                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 15%;"
                                             aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="kt-widget24__action">
														<span class="kt-widget24__change">
															Due date
														</span>
                                        <span class="kt-widget24__number">
															20 Apr, 2019
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-section kt-section--space-md">
                                <div class="kt-widget24 kt-widget24--solid">
                                    <div class="kt-widget24__details">
                                        <div class="kt-widget24__info">
                                            <a href="#" class="kt-widget24__title" title="Click to edit">
                                                eCommerce Solution
                                            </a>
                                            <span class="kt-widget24__desc">
																Zara Retails Shop
															</span>
                                        </div>
                                        <span class="kt-widget24__stats kt-font-success">
															$1,5M
														</span>
                                    </div>
                                    <div class="progress progress--sm">
                                        <div class="progress-bar kt-bg-success" role="progressbar" style="width: 45%;"
                                             aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="kt-widget24__action">
														<span class="kt-widget24__change">
															Launch Date
														</span>
                                        <span class="kt-widget24__number">
															1 Sep, 2021
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-section kt-section--last">
                                <a href="#" class="btn btn-label-brand btn-sm btn-bold"><i class=""></i> See all
                                    deals</a>
                            </div>
                        </div>
                    </div>

                    <!--End:: Portlet-->

                    <!--Begin:: Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Company
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="#" class="btn btn-clean btn-sm btn-bold" data-toggle="dropdown">
                                    <i class="flaticon2-gear"></i> Export
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">

                                    <!--begin::Nav-->
                                    <ul class="kt-nav">
                                        <li class="kt-nav__head">
                                            Company Settings
                                            <i class="flaticon2-information" data-toggle="kt-tooltip"
                                               data-placement="right" title="Click to learn more..."></i>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                <span class="kt-nav__link-text">Update Details</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                <span class="kt-nav__link-text">New Staff</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-link"></i>
                                                <span class="kt-nav__link-text">New Owner</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                                <span class="kt-nav__link-badge">
																	<span class="kt-badge kt-badge--success">5</span>
																</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__separator"></li>
                                        <li class="kt-nav__foot">
                                            <a class="btn btn-label-danger btn-bold btn-sm" href="#">Manage company</a>
                                            <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip"
                                               data-placement="right" title="Click to learn more...">Learn more</a>
                                        </li>
                                    </ul>

                                    <!--end::Nav-->
                                </div>
                            </div>
                        </div>
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="form-group form-group-xs row">
                                    <label class="col-4 col-form-label">Name:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext kt-font-bolder">Loop Inc.</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-4 col-form-label">Location:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext kt-font-bolder">London, UK.</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-4 col-form-label">Revenue:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext"><span
                                                class="kt-font-bolder">345,000M</span> &nbsp;<span
                                                class="kt-badge kt-badge--inline kt-badge--danger kt-badge--bold">Q4, 2019</span></span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-4 col-form-label">Phone:</label>
                                    <div class="col-8">
                                        <span class="form-control-plaintext kt-font-bolder">+456 7890456</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-4 col-form-label">Email:</label>
                                    <div class="col-8">
														<span class="form-control-plaintext kt-font-bolder">
															<a href="#">info@loop.com</a>
														</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-4 col-form-label">Website:</label>
                                    <div class="col-8">
														<span class="form-control-plaintext kt-font-bolder">
															<a href="#">www.loop.com</a>
														</span>
                                    </div>
                                </div>
                                <div class="form-group form-group-xs row">
                                    <label class="col-4 col-form-label">Contact Person:</label>
                                    <div class="col-8">
														<span class="form-control-plaintext kt-font-bolder">
															<a href="#">Nick Bold</a>
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions kt-space-between">
                                    <a href="#" class="btn btn-label-brand btn-sm btn-bold">Manage company</a>
                                    <a href="#" class="btn btn-clean btn-sm btn-bold">Learn more</a>
                                </div>
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
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4"
                                           role="tab">
                                            <i class="flaticon2-user-outline-symbol"></i> Account
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
                        <div class="kt-portlet__body" >
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
                                    <form class="kt-form kt-form--label-right" action="">
                                        <div class="kt-form__body">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">Personal
                                                                Info:</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-avatar kt-avatar--outline"
                                                                 id="kt_apps_user_add_avatar">
                                                                <div class="kt-avatar__holder"></div>
                                                                <label class="kt-avatar__upload"
                                                                       data-toggle="kt-tooltip" title=""
                                                                       data-original-title="Change avatar">
                                                                    <i class="fa fa-pen"></i>
                                                                    <input type="file" name="profile_avatar"
                                                                           accept=".png, .jpg, .jpeg">
                                                                </label>
                                                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip"
                                                                      title="" data-original-title="Cancel avatar">
																					<i class="fa fa-times"></i>
																				</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">First
                                                            Name</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <input class="form-control" type="text" value="Nick">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Last
                                                            Name</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <input class="form-control" type="text" value="Bold">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Company
                                                            Name</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <input class="form-control" type="text" value="Loop Inc.">
                                                            <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">Contact
                                                                Info:</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Contact
                                                            Phone</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="la la-phone"></i></span></div>
                                                                <input type="text" class="form-control"
                                                                       value="+35278953712" placeholder="Phone"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                            <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email
                                                            Address</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="la la-at"></i></span></div>
                                                                <input type="text" class="form-control"
                                                                       value="nick.bold@loop.com" placeholder="Email"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Company
                                                            Site</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control"
                                                                       placeholder="Username" value="loop">
                                                                <div class="input-group-append"><span
                                                                        class="input-group-text">.com</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-xl-3"></div>
                                                <div class="col-lg-9 col-xl-6">
                                                    <a href="#" class="btn btn-label-brand btn-bold">Save changes</a>
                                                    <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                                    <form class="kt-form kt-form--label-right">
                                        <div class="kt-form__body">
                                            <div class="alert alert-solid-danger alert-bold fade show kt-margin-b-20"
                                                 role="alert">
                                                <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
                                                <div class="alert-text">Configure user passwords to expire periodically.
                                                    <br>Users will need warning that their passwords are going to
                                                    expire, or they might inadvertently get locked out of the system!
                                                </div>
                                                <div class="alert-close">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true"><i class="la la-close"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="kt-section">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">
                                                                Account:</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div
                                                                class="kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input">
                                                                <input class="form-control" type="text" value="nick84">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email
                                                            Address</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span
                                                                        class="input-group-text"><i
                                                                            class="la la-at"></i></span></div>
                                                                <input type="text" class="form-control"
                                                                       value="nick.watson@loop.com" placeholder="Email"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                            <span class="form-text text-muted">Email will not be publicly displayed. <a
                                                                    href="#" class="kt-link">Learn more</a>.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Language</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <select class="form-control">
                                                                <option>Select Language...</option>
                                                                <option value="id">Bahasa Indonesia - Indonesian
                                                                </option>
                                                                <option value="msa">Bahasa Melayu - Malay</option>
                                                                <option value="ca">Català - Catalan</option>
                                                                <option value="cs">Čeština - Czech</option>
                                                                <option value="da">Dansk - Danish</option>
                                                                <option value="de">Deutsch - German</option>
                                                                <option value="en" selected="">English</option>
                                                                <option value="en-gb">English UK - British English
                                                                </option>
                                                                <option value="es">Español - Spanish</option>
                                                                <option value="eu">Euskara - Basque (beta)</option>
                                                                <option value="fil">Filipino</option>
                                                                <option value="fr">Français - French</option>
                                                                <option value="ga">Gaeilge - Irish (beta)</option>
                                                                <option value="gl">Galego - Galician (beta)</option>
                                                                <option value="hr">Hrvatski - Croatian</option>
                                                                <option value="it">Italiano - Italian</option>
                                                                <option value="hu">Magyar - Hungarian</option>
                                                                <option value="nl">Nederlands - Dutch</option>
                                                                <option value="no">Norsk - Norwegian</option>
                                                                <option value="pl">Polski - Polish</option>
                                                                <option value="pt">Português - Portuguese</option>
                                                                <option value="ro">Română - Romanian</option>
                                                                <option value="sk">Slovenčina - Slovak</option>
                                                                <option value="fi">Suomi - Finnish</option>
                                                                <option value="sv">Svenska - Swedish</option>
                                                                <option value="vi">Tiếng Việt - Vietnamese</option>
                                                                <option value="tr">Türkçe - Turkish</option>
                                                                <option value="el">Ελληνικά - Greek</option>
                                                                <option value="bg">Български език - Bulgarian</option>
                                                                <option value="ru">Русский - Russian</option>
                                                                <option value="sr">Српски - Serbian</option>
                                                                <option value="uk">Українська мова - Ukrainian</option>
                                                                <option value="he">עִבְרִית - Hebrew</option>
                                                                <option value="ur">اردو - Urdu (beta)</option>
                                                                <option value="ar">العربية - Arabic</option>
                                                                <option value="fa">فارسی - Persian</option>
                                                                <option value="mr">मराठी - Marathi</option>
                                                                <option value="hi">हिन्दी - Hindi</option>
                                                                <option value="bn">বাংলা - Bangla</option>
                                                                <option value="gu">ગુજરાતી - Gujarati</option>
                                                                <option value="ta">தமிழ் - Tamil</option>
                                                                <option value="kn">ಕನ್ನಡ - Kannada</option>
                                                                <option value="th">ภาษาไทย - Thai</option>
                                                                <option value="ko">한국어 - Korean</option>
                                                                <option value="ja">日本語 - Japanese</option>
                                                                <option value="zh-cn">简体中文 - Simplified Chinese</option>
                                                                <option value="zh-tw">繁體中文 - Traditional Chinese
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Time
                                                            Zone</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <select class="form-control">
                                                                <option data-offset="-39600"
                                                                        value="International Date Line West">(GMT-11:00)
                                                                    International Date Line West
                                                                </option>
                                                                <option data-offset="-39600" value="Midway Island">
                                                                    (GMT-11:00) Midway Island
                                                                </option>
                                                                <option data-offset="-39600" value="Samoa">(GMT-11:00)
                                                                    Samoa
                                                                </option>
                                                                <option data-offset="-36000" value="Hawaii">(GMT-10:00)
                                                                    Hawaii
                                                                </option>
                                                                <option data-offset="-28800" value="Alaska">(GMT-08:00)
                                                                    Alaska
                                                                </option>
                                                                <option data-offset="-25200"
                                                                        value="Pacific Time (US &amp; Canada)">
                                                                    (GMT-07:00) Pacific Time (US &amp; Canada)
                                                                </option>
                                                                <option data-offset="-25200" value="Tijuana">(GMT-07:00)
                                                                    Tijuana
                                                                </option>
                                                                <option data-offset="-25200" value="Arizona">(GMT-07:00)
                                                                    Arizona
                                                                </option>
                                                                <option data-offset="-21600"
                                                                        value="Mountain Time (US &amp; Canada)">
                                                                    (GMT-06:00) Mountain Time (US &amp; Canada)
                                                                </option>
                                                                <option data-offset="-21600" value="Chihuahua">
                                                                    (GMT-06:00) Chihuahua
                                                                </option>
                                                                <option data-offset="-21600" value="Mazatlan">
                                                                    (GMT-06:00) Mazatlan
                                                                </option>
                                                                <option data-offset="-21600" value="Saskatchewan">
                                                                    (GMT-06:00) Saskatchewan
                                                                </option>
                                                                <option data-offset="-21600" value="Central America">
                                                                    (GMT-06:00) Central America
                                                                </option>
                                                                <option data-offset="-18000"
                                                                        value="Central Time (US &amp; Canada)">
                                                                    (GMT-05:00) Central Time (US &amp; Canada)
                                                                </option>
                                                                <option data-offset="-18000" value="Guadalajara">
                                                                    (GMT-05:00) Guadalajara
                                                                </option>
                                                                <option data-offset="-18000" value="Mexico City">
                                                                    (GMT-05:00) Mexico City
                                                                </option>
                                                                <option data-offset="-18000" value="Monterrey">
                                                                    (GMT-05:00) Monterrey
                                                                </option>
                                                                <option data-offset="-18000" value="Bogota">(GMT-05:00)
                                                                    Bogota
                                                                </option>
                                                                <option data-offset="-18000" value="Lima">(GMT-05:00)
                                                                    Lima
                                                                </option>
                                                                <option data-offset="-18000" value="Quito">(GMT-05:00)
                                                                    Quito
                                                                </option>
                                                                <option data-offset="-14400"
                                                                        value="Eastern Time (US &amp; Canada)">
                                                                    (GMT-04:00) Eastern Time (US &amp; Canada)
                                                                </option>
                                                                <option data-offset="-14400" value="Indiana (East)">
                                                                    (GMT-04:00) Indiana (East)
                                                                </option>
                                                                <option data-offset="-14400" value="Caracas">(GMT-04:00)
                                                                    Caracas
                                                                </option>
                                                                <option data-offset="-14400" value="La Paz">(GMT-04:00)
                                                                    La Paz
                                                                </option>
                                                                <option data-offset="-14400" value="Georgetown">
                                                                    (GMT-04:00) Georgetown
                                                                </option>
                                                                <option data-offset="-10800"
                                                                        value="Atlantic Time (Canada)">(GMT-03:00)
                                                                    Atlantic Time (Canada)
                                                                </option>
                                                                <option data-offset="-10800" value="Santiago">
                                                                    (GMT-03:00) Santiago
                                                                </option>
                                                                <option data-offset="-10800" value="Brasilia">
                                                                    (GMT-03:00) Brasilia
                                                                </option>
                                                                <option data-offset="-10800" value="Buenos Aires">
                                                                    (GMT-03:00) Buenos Aires
                                                                </option>
                                                                <option data-offset="-9000" value="Newfoundland">
                                                                    (GMT-02:30) Newfoundland
                                                                </option>
                                                                <option data-offset="-7200" value="Greenland">
                                                                    (GMT-02:00) Greenland
                                                                </option>
                                                                <option data-offset="-7200" value="Mid-Atlantic">
                                                                    (GMT-02:00) Mid-Atlantic
                                                                </option>
                                                                <option data-offset="-3600" value="Cape Verde Is.">
                                                                    (GMT-01:00) Cape Verde Is.
                                                                </option>
                                                                <option data-offset="0" value="Azores">(GMT) Azores
                                                                </option>
                                                                <option data-offset="0" value="Monrovia">(GMT)
                                                                    Monrovia
                                                                </option>
                                                                <option data-offset="0" value="UTC">(GMT) UTC</option>
                                                                <option data-offset="3600" value="Dublin">(GMT+01:00)
                                                                    Dublin
                                                                </option>
                                                                <option data-offset="3600" value="Edinburgh">(GMT+01:00)
                                                                    Edinburgh
                                                                </option>
                                                                <option data-offset="3600" value="Lisbon">(GMT+01:00)
                                                                    Lisbon
                                                                </option>
                                                                <option data-offset="3600" value="London">(GMT+01:00)
                                                                    London
                                                                </option>
                                                                <option data-offset="3600" value="Casablanca">
                                                                    (GMT+01:00) Casablanca
                                                                </option>
                                                                <option data-offset="3600" value="West Central Africa">
                                                                    (GMT+01:00) West Central Africa
                                                                </option>
                                                                <option data-offset="7200" value="Belgrade">(GMT+02:00)
                                                                    Belgrade
                                                                </option>
                                                                <option data-offset="7200" value="Bratislava">
                                                                    (GMT+02:00) Bratislava
                                                                </option>
                                                                <option data-offset="7200" value="Budapest">(GMT+02:00)
                                                                    Budapest
                                                                </option>
                                                                <option data-offset="7200" value="Ljubljana">(GMT+02:00)
                                                                    Ljubljana
                                                                </option>
                                                                <option data-offset="7200" value="Prague">(GMT+02:00)
                                                                    Prague
                                                                </option>
                                                                <option data-offset="7200" value="Sarajevo">(GMT+02:00)
                                                                    Sarajevo
                                                                </option>
                                                                <option data-offset="7200" value="Skopje">(GMT+02:00)
                                                                    Skopje
                                                                </option>
                                                                <option data-offset="7200" value="Warsaw">(GMT+02:00)
                                                                    Warsaw
                                                                </option>
                                                                <option data-offset="7200" value="Zagreb">(GMT+02:00)
                                                                    Zagreb
                                                                </option>
                                                                <option data-offset="7200" value="Brussels">(GMT+02:00)
                                                                    Brussels
                                                                </option>
                                                                <option data-offset="7200" value="Copenhagen">
                                                                    (GMT+02:00) Copenhagen
                                                                </option>
                                                                <option data-offset="7200" value="Madrid">(GMT+02:00)
                                                                    Madrid
                                                                </option>
                                                                <option data-offset="7200" value="Paris">(GMT+02:00)
                                                                    Paris
                                                                </option>
                                                                <option data-offset="7200" value="Amsterdam">(GMT+02:00)
                                                                    Amsterdam
                                                                </option>
                                                                <option data-offset="7200" value="Berlin">(GMT+02:00)
                                                                    Berlin
                                                                </option>
                                                                <option data-offset="7200" value="Bern">(GMT+02:00)
                                                                    Bern
                                                                </option>
                                                                <option data-offset="7200" value="Rome">(GMT+02:00)
                                                                    Rome
                                                                </option>
                                                                <option data-offset="7200" value="Stockholm">(GMT+02:00)
                                                                    Stockholm
                                                                </option>
                                                                <option data-offset="7200" value="Vienna">(GMT+02:00)
                                                                    Vienna
                                                                </option>
                                                                <option data-offset="7200" value="Cairo">(GMT+02:00)
                                                                    Cairo
                                                                </option>
                                                                <option data-offset="7200" value="Harare">(GMT+02:00)
                                                                    Harare
                                                                </option>
                                                                <option data-offset="7200" value="Pretoria">(GMT+02:00)
                                                                    Pretoria
                                                                </option>
                                                                <option data-offset="10800" value="Bucharest">
                                                                    (GMT+03:00) Bucharest
                                                                </option>
                                                                <option data-offset="10800" value="Helsinki">(GMT+03:00)
                                                                    Helsinki
                                                                </option>
                                                                <option data-offset="10800" value="Kiev">(GMT+03:00)
                                                                    Kiev
                                                                </option>
                                                                <option data-offset="10800" value="Kyiv">(GMT+03:00)
                                                                    Kyiv
                                                                </option>
                                                                <option data-offset="10800" value="Riga">(GMT+03:00)
                                                                    Riga
                                                                </option>
                                                                <option data-offset="10800" value="Sofia">(GMT+03:00)
                                                                    Sofia
                                                                </option>
                                                                <option data-offset="10800" value="Tallinn">(GMT+03:00)
                                                                    Tallinn
                                                                </option>
                                                                <option data-offset="10800" value="Vilnius">(GMT+03:00)
                                                                    Vilnius
                                                                </option>
                                                                <option data-offset="10800" value="Athens">(GMT+03:00)
                                                                    Athens
                                                                </option>
                                                                <option data-offset="10800" value="Istanbul">(GMT+03:00)
                                                                    Istanbul
                                                                </option>
                                                                <option data-offset="10800" value="Minsk">(GMT+03:00)
                                                                    Minsk
                                                                </option>
                                                                <option data-offset="10800" value="Jerusalem">
                                                                    (GMT+03:00) Jerusalem
                                                                </option>
                                                                <option data-offset="10800" value="Moscow">(GMT+03:00)
                                                                    Moscow
                                                                </option>
                                                                <option data-offset="10800" value="St. Petersburg">
                                                                    (GMT+03:00) St. Petersburg
                                                                </option>
                                                                <option data-offset="10800" value="Volgograd">
                                                                    (GMT+03:00) Volgograd
                                                                </option>
                                                                <option data-offset="10800" value="Kuwait">(GMT+03:00)
                                                                    Kuwait
                                                                </option>
                                                                <option data-offset="10800" value="Riyadh">(GMT+03:00)
                                                                    Riyadh
                                                                </option>
                                                                <option data-offset="10800" value="Nairobi">(GMT+03:00)
                                                                    Nairobi
                                                                </option>
                                                                <option data-offset="10800" value="Baghdad">(GMT+03:00)
                                                                    Baghdad
                                                                </option>
                                                                <option data-offset="14400" value="Abu Dhabi">
                                                                    (GMT+04:00) Abu Dhabi
                                                                </option>
                                                                <option data-offset="14400" value="Muscat">(GMT+04:00)
                                                                    Muscat
                                                                </option>
                                                                <option data-offset="14400" value="Baku">(GMT+04:00)
                                                                    Baku
                                                                </option>
                                                                <option data-offset="14400" value="Tbilisi">(GMT+04:00)
                                                                    Tbilisi
                                                                </option>
                                                                <option data-offset="14400" value="Yerevan">(GMT+04:00)
                                                                    Yerevan
                                                                </option>
                                                                <option data-offset="16200" value="Tehran">(GMT+04:30)
                                                                    Tehran
                                                                </option>
                                                                <option data-offset="16200" value="Kabul">(GMT+04:30)
                                                                    Kabul
                                                                </option>
                                                                <option data-offset="18000" value="Ekaterinburg">
                                                                    (GMT+05:00) Ekaterinburg
                                                                </option>
                                                                <option data-offset="18000" value="Islamabad">
                                                                    (GMT+05:00) Islamabad
                                                                </option>
                                                                <option data-offset="18000" value="Karachi">(GMT+05:00)
                                                                    Karachi
                                                                </option>
                                                                <option data-offset="18000" value="Tashkent">(GMT+05:00)
                                                                    Tashkent
                                                                </option>
                                                                <option data-offset="19800" value="Chennai">(GMT+05:30)
                                                                    Chennai
                                                                </option>
                                                                <option data-offset="19800" value="Kolkata">(GMT+05:30)
                                                                    Kolkata
                                                                </option>
                                                                <option data-offset="19800" value="Mumbai">(GMT+05:30)
                                                                    Mumbai
                                                                </option>
                                                                <option data-offset="19800" value="New Delhi">
                                                                    (GMT+05:30) New Delhi
                                                                </option>
                                                                <option data-offset="19800" value="Sri Jayawardenepura">
                                                                    (GMT+05:30) Sri Jayawardenepura
                                                                </option>
                                                                <option data-offset="20700" value="Kathmandu">
                                                                    (GMT+05:45) Kathmandu
                                                                </option>
                                                                <option data-offset="21600" value="Astana">(GMT+06:00)
                                                                    Astana
                                                                </option>
                                                                <option data-offset="21600" value="Dhaka">(GMT+06:00)
                                                                    Dhaka
                                                                </option>
                                                                <option data-offset="21600" value="Almaty">(GMT+06:00)
                                                                    Almaty
                                                                </option>
                                                                <option data-offset="21600" value="Urumqi">(GMT+06:00)
                                                                    Urumqi
                                                                </option>
                                                                <option data-offset="23400" value="Rangoon">(GMT+06:30)
                                                                    Rangoon
                                                                </option>
                                                                <option data-offset="25200" value="Novosibirsk">
                                                                    (GMT+07:00) Novosibirsk
                                                                </option>
                                                                <option data-offset="25200" value="Bangkok">(GMT+07:00)
                                                                    Bangkok
                                                                </option>
                                                                <option data-offset="25200" value="Hanoi">(GMT+07:00)
                                                                    Hanoi
                                                                </option>
                                                                <option data-offset="25200" value="Jakarta">(GMT+07:00)
                                                                    Jakarta
                                                                </option>
                                                                <option data-offset="25200" value="Krasnoyarsk">
                                                                    (GMT+07:00) Krasnoyarsk
                                                                </option>
                                                                <option data-offset="28800" value="Beijing">(GMT+08:00)
                                                                    Beijing
                                                                </option>
                                                                <option data-offset="28800" value="Chongqing">
                                                                    (GMT+08:00) Chongqing
                                                                </option>
                                                                <option data-offset="28800" value="Hong Kong">
                                                                    (GMT+08:00) Hong Kong
                                                                </option>
                                                                <option data-offset="28800" value="Kuala Lumpur">
                                                                    (GMT+08:00) Kuala Lumpur
                                                                </option>
                                                                <option data-offset="28800" value="Singapore">
                                                                    (GMT+08:00) Singapore
                                                                </option>
                                                                <option data-offset="28800" value="Taipei">(GMT+08:00)
                                                                    Taipei
                                                                </option>
                                                                <option data-offset="28800" value="Perth">(GMT+08:00)
                                                                    Perth
                                                                </option>
                                                                <option data-offset="28800" value="Irkutsk">(GMT+08:00)
                                                                    Irkutsk
                                                                </option>
                                                                <option data-offset="28800" value="Ulaan Bataar">
                                                                    (GMT+08:00) Ulaan Bataar
                                                                </option>
                                                                <option data-offset="32400" value="Seoul">(GMT+09:00)
                                                                    Seoul
                                                                </option>
                                                                <option data-offset="32400" value="Osaka">(GMT+09:00)
                                                                    Osaka
                                                                </option>
                                                                <option data-offset="32400" value="Sapporo">(GMT+09:00)
                                                                    Sapporo
                                                                </option>
                                                                <option data-offset="32400" value="Tokyo">(GMT+09:00)
                                                                    Tokyo
                                                                </option>
                                                                <option data-offset="32400" value="Yakutsk">(GMT+09:00)
                                                                    Yakutsk
                                                                </option>
                                                                <option data-offset="34200" value="Darwin">(GMT+09:30)
                                                                    Darwin
                                                                </option>
                                                                <option data-offset="34200" value="Adelaide">(GMT+09:30)
                                                                    Adelaide
                                                                </option>
                                                                <option data-offset="36000" value="Canberra">(GMT+10:00)
                                                                    Canberra
                                                                </option>
                                                                <option data-offset="36000" value="Melbourne">
                                                                    (GMT+10:00) Melbourne
                                                                </option>
                                                                <option data-offset="36000" value="Sydney">(GMT+10:00)
                                                                    Sydney
                                                                </option>
                                                                <option data-offset="36000" value="Brisbane">(GMT+10:00)
                                                                    Brisbane
                                                                </option>
                                                                <option data-offset="36000" value="Hobart">(GMT+10:00)
                                                                    Hobart
                                                                </option>
                                                                <option data-offset="36000" value="Vladivostok">
                                                                    (GMT+10:00) Vladivostok
                                                                </option>
                                                                <option data-offset="36000" value="Guam">(GMT+10:00)
                                                                    Guam
                                                                </option>
                                                                <option data-offset="36000" value="Port Moresby">
                                                                    (GMT+10:00) Port Moresby
                                                                </option>
                                                                <option data-offset="36000" value="Solomon Is.">
                                                                    (GMT+10:00) Solomon Is.
                                                                </option>
                                                                <option data-offset="39600" value="Magadan">(GMT+11:00)
                                                                    Magadan
                                                                </option>
                                                                <option data-offset="39600" value="New Caledonia">
                                                                    (GMT+11:00) New Caledonia
                                                                </option>
                                                                <option data-offset="43200" value="Fiji">(GMT+12:00)
                                                                    Fiji
                                                                </option>
                                                                <option data-offset="43200" value="Kamchatka">
                                                                    (GMT+12:00) Kamchatka
                                                                </option>
                                                                <option data-offset="43200" value="Marshall Is.">
                                                                    (GMT+12:00) Marshall Is.
                                                                </option>
                                                                <option data-offset="43200" value="Auckland">(GMT+12:00)
                                                                    Auckland
                                                                </option>
                                                                <option data-offset="43200" value="Wellington">
                                                                    (GMT+12:00) Wellington
                                                                </option>
                                                                <option data-offset="46800" value="Nuku'alofa">
                                                                    (GMT+13:00) Nuku'alofa
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label
                                                            class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-checkbox-inline">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked=""> Email
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked=""> SMS
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> Phone
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">
                                                                Security:</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Login
                                                            verification</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <button type="button"
                                                                    class="btn btn-label-brand btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">
                                                                Setup login verification
                                                            </button>
                                                            <span class="form-text text-muted">
																				After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised.
																				<a href="#"
                                                                                   class="kt-link">Learn more</a>.
																			</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Password reset
                                                            verification</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-checkbox-single">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> Require personal information
                                                                    to reset your password.
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                            <span class="form-text text-muted">
																				For extra security, this requires you to confirm your email or phone number when you reset your password.
																				<a href="#"
                                                                                   class="kt-link">Learn more</a>.
																			</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <button type="button"
                                                                    class="btn btn-label-danger btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">
                                                                Deactivate your account ?
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-xl-3"></div>
                                                <div class="col-lg-9 col-xl-6">
                                                    <a href="#" class="btn btn-label-brand btn-bold">Save changes</a>
                                                    <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!--End:: Tab Content-->

                                <!--Begin:: Tab Content-->
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_5" role="tabpanel">
                                    <form class="kt-form kt-form--label-right">
                                        <div class="kt-form__body">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">Setup
                                                                Email Notification:</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-sm row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email
                                                            Notification</label>
                                                        <div class="col-lg-9 col-xl-6">
																			<span class="kt-switch">
																				<label>
																					<input type="checkbox"
                                                                                           checked="checked"
                                                                                           name="email_notification_1">
																					<span></span>
																				</label>
																			</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Send Copy To
                                                            Personal Email</label>
                                                        <div class="col-lg-9 col-xl-6">
																			<span class="kt-switch">
																				<label>
																					<input type="checkbox"
                                                                                           name="email_notification_2">
																					<span></span>
																				</label>
																			</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">Activity
                                                                Related Emails:</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">When To
                                                            Email</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> You have new notifications.
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> You're sent a direct message
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked="checked"> Someone
                                                                    adds you as a connection
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-last row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">When To Escalate
                                                            Emails</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox--brand">
                                                                    <input type="checkbox"> Upon new order.
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--brand">
                                                                    <input type="checkbox"> New membership approval
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox kt-checkbox--brand">
                                                                    <input type="checkbox" checked="checked"> Member
                                                                    registration
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-section__body">
                                                    <div class="row">
                                                        <label class="col-xl-3"></label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <h3 class="kt-section__title kt-section__title-sm">Updates
                                                                From Keenthemes:</h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Email You
                                                            With</label>
                                                        <div class="col-lg-9 col-xl-6">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> News about Metronic product
                                                                    and feature updates
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox"> Tips on getting more out of
                                                                    Keen
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked="checked"> Things you
                                                                    missed since you last logged into Keen
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked="checked"> News about
                                                                    Metronic on partner products and other services
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" checked="checked"> Tips on
                                                                    Metronic business products
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-xl-3"></div>
                                                <div class="col-lg-9 col-xl-6">
                                                    <a href="#" class="btn btn-label-brand btn-bold">Save changes</a>
                                                    <a href="#" class="btn btn-clean btn-bold">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

                                                        <a href="{{route('payment.create')}}" class="btn btn-brand btn-elevate btn-icon-sm"
                                                               data-toggle="modal" data-target=".new_payment" ><i class="la la-plus"></i>
                                                            New Payment
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--begin: Datatable -->
                                        <div    class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                    <table id="datatable-responsive"
                                               class="table table-striped table-bordered dt-responsive  nowrap "
                                               cellspacing="0" width="100%"
                                        >
                                            <thead>
                                            <tr>
                                                <th> ID</th>
                                                <th>Name</th>
                                                <th>unit</th>
                                                <th>barcode</th>
                                                <th>reorder point</th>
                                                <th>vat</th>
                                                <th>action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($payments as $payment)


{{--                                                <tr>--}}
{{--                                                    <td>{{$payment->id}}</td>--}}
{{--                                                    <td>{{$payment->name}}</td>--}}
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
                <form action="{{url('payment.store')}}" method="post" enctype="multipart/form-data">
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
                                        <input type="text" readonly class="form-control" id="currentDue">
                                        <input type="hidden" name="sender_id" value="{{Auth::user()->id}}" >
                                        <input type="hidden" name="receiver_id" value="" >
                                        {{--  value="{{$totalPursesAmount -$totalPursesPayment}}">--}}
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
                                    <label class=control-label">{{ trans('main.file') }} :</label>
                                    <input type="file" name="image" class="form-control">


                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="col-12 pull-left">
                            <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">supmit</button>
                        </div>
                    </div>                    </form>

            </div>
        </div>
    </div>















@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>

    <script>
        $.fn.dataTableExt.ofnSearch['html-input'] = function (value) {
            return $(value).val();
        };
        $(document).ready(function () {
            // $('#updatemodel').on('show.bs.modal', function (e) {
            //     var Id = $(e.relatedTarget).data('id');
            //     var name = $(e.relatedTarget).data('name');
            //     var unit = $(e.relatedTarget).data('unit');
            //     var reorder = $(e.relatedTarget).data('reorder');
            //     var barcode = $(e.relatedTarget).data('barcode');
            //     var vat = $(e.relatedTarget).data('vat');
            //     $(e.currentTarget).find('input[name="id"]').val(Id);
            //     $(e.currentTarget).find('input[name="name"]').val(name);
            //     $(e.currentTarget).find('select[name="unit"]').val(unit);
            //     $(e.currentTarget).find('input[name="reorder"]').val(reorder);
            //     $(e.currentTarget).find('input[name="barcode"]').val(barcode);
            //     $(e.currentTarget).find('input[name="vat"]').val(vat);
            // });
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
