<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Brand -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{url('/')}}">
                <img alt="Logo" class="img-fluid" src="{{asset('/media/logos/favicon.ico')}}"/>
            </a>
        </div>
    </div>

    <!-- end:: Brand -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid"
         id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu"
             class="kt-aside-menu  kt-aside-menu--dropdown "
             data-ktmenu-vertical="1" data-ktmenu-dropdown="1"
             data-ktmenu-scroll="0">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item">
                    <a href="{{route('dashboard.pos')}}" class="kt-menu__link ">
                        <img class="img-fluid"style=" height: 100%"  src="{{asset('media/icons/dasbaoard.png')}}"/>
                    </a>

                    <span style=" text-align: center">{{trans('main.dashboard')}}</span>
                </li>
                <li class="kt-menu__item">
                    <a href="{{url('pos/life-kitchen')}}" class="kt-menu__link ">
                        <img class="img-fluid"style=" height: 100%"  src="{{asset('media/icons/camera.png')}}"/>
                    </a>

                    <span style=" text-align: center">{{trans('main.life kitchen')}}</span>
                </li>
                <li class="kt-menu__item">
                    <a href="{{url('pos/order')}}?type=restaurant" class="kt-menu__link ">
                        <img class="img-fluid"style="height: 100%"  src="{{asset('/media/icons/pos/order_list.png')}}"/>
                    </a>

                    <span style="text-align: center"> {{trans('main.order List')}} </span>
                </li>

                <li class="kt-menu__item">
                    <a href="{{url('pos/hall')}}" class="kt-menu__link ">
                        <img class="img-fluid"style="height: 100%"  src="{{asset('/media/icons/pos/resturant.png')}}"/>
                    </a>

                    <span style="text-align: center"> {{trans('main.food court')}} </span>
                </li>
                <li class="kt-menu__item">
                    <a  href="{{route('order.create')}}?type=takeaway" class="kt-menu__link ">
                        <img class="img-fluid"style="height: 100%"  src="{{asset('/media/icons/pos/takeaway1.png')}}"/>
                    </a>

                    <span style="text-align: center">{{trans('main.takeaway')}}</span>
                </li>
                <li class="kt-menu__item">
                    <a  href="{{route('order.create')}}?type=delivery" class="kt-menu__link ">
                        <img class="img-fluid"style="height: 100%"  src="{{asset('/media/icons/pos/delivery1.png')}}"/>
                    </a>

                    <span style="text-align: center">{{trans('main.delivery')}}</span>
                </li>






                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--bottom-1" aria-haspopup="true"
                    data-ktmenu-submenu-toggle="click">    <a  href="{{route('client.index')}}"  class="kt-menu__link ">
                        <img class="img-fluid" style="height: 100%" src="{{asset('/media/icons/pos/customer.png')}}"/>
                    </a>
                    <span style="text-align: center">{{trans('main.customer')}}</span>

                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>
<div class="kt-aside-menu-overlay"></div>
<!-- end:: Aside -->

