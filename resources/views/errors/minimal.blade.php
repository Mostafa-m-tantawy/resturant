
@extends( (!Request()->route())? 'errors.layout':((Request()->route()->getPrefix()=='/pos')?'pos.layout.pos_app' :'layouts.welcome') )
@section('title')
    {{trans('main.error')}} - @yield('code')
@stop

@section('head')

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{asset('/css/demo1/pages/general/error/error-6.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->
@stop
@section('content')

    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6"style="background-attachment: unset;background-image: url({{asset('/media//error/bg6.jpg')}});" >
            <div class="kt-error_container">
                <div class="kt-error_subtitle kt-font-light">
                    <h1> @yield('code')</h1>
                </div>
                <p class="kt-error_description kt-font-light">
                    @yield('message')
                </p>
            </div>
        </div>
    </div>
@stop
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--        <title>@yield('title')</title>--}}

{{--        <!-- Fonts -->--}}
{{--        <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--        <!-- Styles -->--}}
{{--        <style>--}}
{{--            html, body {--}}
{{--                background-color: #fff;--}}
{{--                color: #636b6f;--}}
{{--                font-family: 'Nunito', sans-serif;--}}
{{--                font-weight: 100;--}}
{{--                height: 100vh;--}}
{{--                margin: 0;--}}
{{--            }--}}

{{--            .full-height {--}}
{{--                height: 100vh;--}}
{{--            }--}}

{{--            .flex-center {--}}
{{--                align-items: center;--}}
{{--                display: flex;--}}
{{--                justify-content: center;--}}
{{--            }--}}

{{--            .position-ref {--}}
{{--                position: relative;--}}
{{--            }--}}

{{--            .code {--}}
{{--                border-right: 2px solid;--}}
{{--                font-size: 26px;--}}
{{--                padding: 0 15px 0 15px;--}}
{{--                text-align: center;--}}
{{--            }--}}

{{--            .message {--}}
{{--                font-size: 18px;--}}
{{--                text-align: center;--}}
{{--            }--}}
{{--        </style>--}}
{{--    </head>--}}
{{--    <body>--}}
{{--        <div class="flex-center position-ref full-height">--}}
{{--            <div class="code">--}}
{{--                @yield('code')--}}
{{--            </div>--}}

{{--            <div class="message" style="padding: 10px;">--}}
{{--                @yield('message')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}
