@extends('layouts.app')

@section('appcontent')


    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <!-- begin:: Aside -->

          @if(Request()->route()->getPrefix()=='/hr')
              @include('layouts.partials.hr_SideBar')
          @elseif(Request()->route()->getPrefix()=='/stock')
              @include('layouts.partials.stock_sidebar')
          @elseif(Request()->route()->getPrefix()=='/cost')
              @include('layouts.partials.cost_sidebar')
          @elseif(Request()->route()->getPrefix()=='/pos')
              @include('.pos.layout.partial.sidebar')
          @elseif(Request()->route()->getPrefix()=='/conf')
              @include('layouts.partials.conf_SideBar')
          @elseif(Request()->route()->getPrefix()=='/cashier')
              @include('layouts.partials.cashier_SideBar')
{{--              @else--}}
{{--              @include('layouts.partials.sidebar')--}}

              @endif
        <!-- end:: Aside -->

            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
            @include('layouts.partials.header')

                    <!-- end:: Header -->


                <!-- begin:: content -->
                @yield('content')
                <!-- end:: content -->



                <!-- begin:: Footer -->
            @include('layouts.partials.footer')
                <!-- end:: Footer -->
            </div>
        </div>
    </div>
@endsection




