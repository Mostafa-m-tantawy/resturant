@extends('.pos.layout.pos_app')

@section('title')
    {{trans('main.create order')}}
@stop



@section('content')
    <meta name="service" content="  {{$systemconf->where('name','service')->first()->value}}">
    <meta name="vat" content="{{$systemconf->where('name','vat')->first()->value}}">
    <meta name="delivery" content="{{$systemconf->where('name','delivery')->first()->value}}">
    <meta name="type" content="{{$type}}">
    <meta name="table" content="{{$table}}">




    <style>
        span {
            cursor: pointer;
        }

        .number {
            margin: 100px;
        }

        .minus, .plus {
            width: 30px;
            height: 30px;
            background: #f2f2f2;
            border-radius: 4px;
            padding: 2px 0px 2px 0px;
            border: 1px solid #ddd;
            display: inline-block;
            vertical-align: middle;
            text-align: center;
        }

        .quantity {
            height: 25px;
            width: 40px;
            text-align: center;
            font-size: 26px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
        }

        .table th, .table td {
            padding: unset;
        }
    </style>
    <div class="container-fluid" >
        <div class="row">
        <div class="col-7">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                           {{trans('main.dishes')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        @foreach($categories as $category)
                            <li class="nav-item">

                                <a class="nav-link @if($loop->first) active @endif" id="{{str_replace(' ', '', $category->name)}}-tab"
                                   data-toggle="tab" href="#{{str_replace(' ', '', $category->name)}}" role="tab"
                                   aria-controls="{{str_replace(' ', '', $category->name)}}" aria-selected="true">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($categories as $category)


                            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{str_replace(' ', '', $category->name)}}"
                                 role="tabpanel" aria-labelledby="{{str_replace(' ', '', $category->name)}}-tab">
                                <div class="row">
                                    @foreach($category->dishes->where('StockAvailable','available') as $dish)
{{--                                        ->where('StockAvailable','available')--}}

                                        <div class="col-2">
                                            <div class="kt-portlet kt-portlet--height-fluid">
{{--                                                <div class="kt-portlet__body kt-portlet__body--fit-y">--}}
                                                    <!--begin::Widget -->
                                                    <div class="kt-widget kt-widget--user-profile-4">
                                                        <div class="kt-widget__head">
                                                            <a onclick="newDish({{$dish->id}})">
                                                                    <img style="height: 100px" class="img-fluid"
                                                                         src="{{asset($dish->image)}}"
                                                                         alt="image">
                                                               </a>
                                                            <div class="kt-widget__content">
                                                                <div class="kt-widget__section">
                                                                    <a onclick="newDish({{$dish->id}})"
                                                                       class="kt-widget__username">
                                                                        {{$dish->name}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--end::Widget -->
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    @endforeach


                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>
            </div>

        </div>
        <div class="col-5">

            <!-- begin:: Content -->
            <div class="row">
                <div class="col-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{trans('main.invoice')}}

                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table table-borderless" id="invoice">
                                <thead>
                                <tr>
                                    <th>{{trans('main.dish')}}</th>
                                    <th>{{trans('main.size')}}</th>
                                    <th style="text-align: center;">{{trans('main.quantity')}}</th>
                                    <th style="text-align: center; width: 75px">{{trans('main.price')}}</th>
                                    <th style="text-align: right;">{{trans('main.del')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end:: Content -->
        </div>
    </div>
    </div>


    <div class="modal fade sizes_modal" id="sizes_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.sizes')}} <span class="name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="row" id="sizes">


                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <h1> {{trans('main.details')}}</h1>
                                    <table class="table dish_details">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade sides_modal" id="sides_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.sides')}} </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <h6 class="pull-right">{{trans('main.available sides')}} -
                                (<span id="available_sides"></span>)
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="row" id="sides">


                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <h1> {{trans('main.details')}}</h1>
                                    <table class="table dish_details">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-12 pull-left">
                        <button class="btn btn-primary" onclick="DishSides()">
                            {{trans('main.extras')}}</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="modal fade extra_modal" id="extra_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.extras')}} <span class="name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="row" id="extras">


                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <h1> {{trans('main.details')}}</h1>
                                    <table class="table dish_details">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="col-12 pull-left">
                        <button class="btn btn-primary" onclick="DishExtra()">
                            {{trans('main.finish')}}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop


@section('scripts')

    <script src="{{ url('/app_js/posneworder.js') }}"></script>
    <script>


    </script>
@stop
