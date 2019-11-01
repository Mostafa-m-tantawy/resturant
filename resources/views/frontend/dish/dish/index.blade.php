@extends('layouts.welcome')
@section('head')
    <link href="{{asset('css/demo1/pages/general/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('style')
    <style>
        .nav-pills .nav-link {
            color: #0b2e13;;
        }

        .nav-pills .nav-link:hover {
            background-color: darkkhaki;
            color: #0b2e13;;
        }

        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;;
            background-color: darkslategrey;
        }

        .nav-link {
            height: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 20px;
        }
    </style>
@endsection

@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" style="background-color: white">
        <div class="kt-portlet" style="height: 100%">
            <div class="kt-portlet__body kt-portlet__body--fit" style="height: 100%">

                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper" style="height: 100%">


           @if($categories->count()>0)

                        <div class="row" style="height: 100%">
                        <div class="col-2" style=" padding-right:unset;height: 100%">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <div style="height: 100px; background-color: darkslategrey"></div>
                                @foreach($categories as $category)
                                    <a class="nav-link @if($loop->first) active @endif"
                                       id="v-pills-{{$category->id}}-tab"
                                       data-toggle="pill" href="#v-pills-{{$category->id}}"
                                       role="tab" aria-controls="v-pills-{{$category->id}}"
                                       aria-selected="@if($loop->first)true @else false @endif">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-10" style="padding-left:unset;height: 100%">
                            <div class="tab-content" id="v-pills-tabContent" style="height: 100%">
                                @foreach($categories as $category)


                                        <div class="tab-pane fade  @if($loop->first) show active @endif"
                                             style="height: 100%" id="v-pills-{{$category->id}}"
                                             role="tabpane{{$category->id}}"
                                             aria-labelledby="v-pills-{{$category->id}}-tab">
                                            <div class="container-fluid" style="height: 100%"
                                                 style="background-color: #0abb87">

                                                <div class="row" style="height: 100%">
                                                    <div class="col-1"
                                                         style=" height: 100%;background-color: darkslategrey ">

                                                    </div>

                                                    <div class="col-11" style="  height: 100%">
                                                        <div class="row">
                                                            <div class="col-12"
                                                                 style="color: darkkhaki; padding: 30px; text-align: center; font-size:30px;font-weight: bolder;  background-color: darkslategrey ">
                                                                {{$category->name}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="kt-portlet kt-portlet--height-fluid">

                                                                    <div class="kt-portlet__body" style="padding:10px">
                                                                        @foreach($category->dishes as $dish)
                                                                        <div class="kt-widget5">
                                                                            <div class="kt-widget5__item" style="padding: unset; ">
                                                                                <div class="kt-widget5__content">
                                                                                    <div class="kt-widget5__pic">
                                                                                        <img class="kt-widget7__img"
                                                                                             src="/media//products/product27.jpg"
                                                                                             alt="">
                                                                                    </div>
                                                                                    <div class="kt-widget5__section">
                                                                                        <a href="#"
                                                                                           class="kt-widget5__title">
                                                                                            {{$dish->name}}
                                                                                        </a>
                                                                                        <p class="kt-widget5__desc">
                                                                                            {{$dish->discription}}
                                                                                        </p>
                                                                                        <div class="kt-widget5__info">
{{--                                                                                            <span>Author:</span>--}}
{{--                                                                                            <span class="kt-font-info">Keenthemes</span>--}}
{{--                                                                                            <span>Released:</span>--}}
{{--                                                                                            <span--}}
{{--                                                                                                class="kt-font-info">23.08.17</span>--}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="kt-widget5__content">
                                                                                    <div class="kt-widget5__stats">
                                                                                <span
                                                                                    class="kt-widget5__number">
                                                                                    <a href="{{url('dish/'.$dish->id.'/edit')}}">
                                                                                        <i style="font-size: 40px;"
                                                                                           class="flaticon-edit-1"></i>
                                                                                    </a>
                                                                                </span>

                                                                                        <span
                                                                                            class="kt-widget5__sales">{{trans('main.update')}} </span>
                                                                                    </div>
                                                                                    <div class="kt-widget5__stats">
                                                                                <span class="kt-widget5__number">
                                                                                     <a href="{{url('dish/'.$dish->id.'/edit')}}">
                                                                                     <img style="height: 50px"
                                                                                          src="media/icons/svg/Communication/Clipboard-list.svg"/>
                                                                                     </a>
                                                                                </span>
                                                                                        <span
                                                                                            class="kt-widget5__votes">{{trans('main.recipe')}} </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach



                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                @endforeach

                            </div>
                        </div>
                    </div>

             @else
               <div class="row" style="height: 100%">
                   <div class="col" style="    text-align: center;align-self: center;">

                       <h3>{{trans('main.There Is No Menu To show')}}
                       </h3>
                   </div>
               </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    {{----}}


@stop
