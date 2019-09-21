@extends('layouts.app')

@section('appcontent')


    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <!-- begin:: Aside -->

            @include('layouts.partials.sidebar')
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




