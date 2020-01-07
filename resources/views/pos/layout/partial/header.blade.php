<div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
    </div>

    <!-- end: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">

        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
									<span class="kt-header__topbar-icon">

                                        @if (App::isLocale('ar'))
                                            <img class="" src="{{asset('/media/flags/008-saudi-arabia.svg')}}" alt="" />
                                        @else
                                            <img class="" src="{{asset('/media/flags/020-flag.svg')}}" alt="" />
                                        @endif
									</span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    <form action="{{url('chang-lang')}}" method="post"  id="form_en">
                        @csrf
                        <input type="hidden" name="lang" value="en">
                        <li class="kt-nav__item kt-nav__item--active" onclick="document.getElementById('form_en').submit();">
                            <a  class="kt-nav__link">
                                <span class="kt-nav__link-icon"><img src="{{asset('/media/flags/020-flag.svg')}}" alt="" /></span>
                                <span class="kt-nav__link-text">English</span>
                            </a>
                        </li>

                    </form>
                    <form action="{{url('chang-lang')}}" method="post"  id="form_ar">
                        @csrf
                        <input type="hidden" name="lang" value="ar">
                        <li class="kt-nav__item"  onclick="document.getElementById('form_ar').submit();">
                            <a class="kt-nav__link">
                                <span class="kt-nav__link-icon"><img src="{{asset('/media/flags/008-saudi-arabia.svg')}}" alt="" /></span>
                                <span class="kt-nav__link-text">Arabic</span>
                            </a>
                        </li>
                    </form>

                </ul>
            </div>
        </div>

        <!--begin: User bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                <span class="kt-hidden kt-header__topbar-username">{{Auth::user()->name}}</span>
                <img class="kt-hidden" alt="Pic" src="{{asset('/media/users/300_21.jpg')}}" />
                <span class="kt-header__topbar-icon"><i class="flaticon2-user-outline-symbol"></i></span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden-" alt="Pic" src="{{asset('/media/users/300_25.jpg')}}" />

                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                    </div>
                    <div class="kt-user-card__name">
                        {{Auth::user()->name}}
                    </div>

                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">


                     <div class="kt-notification__custom kt-space-between">
                         <a href="{{url('logout')}}" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                     </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User bar -->


    </div>

    <!-- end:: Header Topbar -->
</div>
