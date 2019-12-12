@extends('.pos.layout.pos_app')
@section('content')
    <meta name="service" content="  {{$systemconf->where('name','service')->first()->value}}">
    <meta name="vat" content="{{$systemconf->where('name','vat')->first()->value}}">
    <meta name="type" content="{{$type}}">
    <meta name="order_id" content="{{$order_id}}">




    <style>
        span {cursor:pointer; }
        .number{
            margin:100px;
        }
        .minus, .plus{
            width:30px;
            height:30px;
            background:#f2f2f2;
            border-radius:4px;
            padding:2px 0px 2px 0px;
            border:1px solid #ddd;
            display: inline-block;
            vertical-align: middle;
            text-align: center;
        }
        .quantity {
            height:25px;
            width: 40px;
            text-align: center;
            font-size: 26px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
        }.table th, .table td {
             padding: unset;
         }
    </style>
    <div class="row">
        <div class="col-7">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Adjusted Tabs
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        @foreach($categories as $category)
                            <li class="nav-item">

                                <a class="nav-link @if($loop->first) active @endif" id="{{$category->name}}-tab"
                                   data-toggle="tab" href="#{{$category->name}}" role="tab"
                                   aria-controls="{{$category->name}}" aria-selected="true">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($categories as $category)


                            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{$category->name}}"
                                 role="tabpanel" aria-labelledby="{{$category->name}}-tab">
                                <div class="row">
                                    @foreach($category->dishes as $dish)

                                        <div class="col-2">
                                            <div class="kt-portlet kt-portlet--height-fluid">
                                                <div class="kt-portlet__head kt-portlet__head--noborder"></div>
                                                <div class="kt-portlet__body kt-portlet__body--fit-y">
                                                    <!--begin::Widget -->
                                                    <div class="kt-widget kt-widget--user-profile-4">
                                                        <div class="kt-widget__head">
                                                            <a onclick="newDish({{$dish->id}})">
                                                                <div class="kt-widget__media">
                                                                    <img class="kt-widget__img kt-hidden-"
                                                                         src="/media/users/300_21.jpg"
                                                                         alt="image">
                                                                </div>
                                                            </a>
                                                            <div class="kt-widget__content">
                                                                <div class="kt-widget__section">
                                                                    <a onclick="newDish({{$dish->id}})"
                                                                       class="kt-widget__username">
                                                                        {{$dish->name}}
                                                                    </a>
                                                                    <div class="kt-widget__button">
                                                                        <span class="btn btn-label-warning btn-sm">Active</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--end::Widget -->
                                                </div>
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
                                    invoice
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table table-borderless"  id="invoice">
                                <thead>
                                <tr>
                                    <th>{{trans('main.dish')}}</th>
                                    <th>{{trans('main.size')}}</th>
                                    <th>{{trans('main.quantity')}}</th>
                                    <th>{{trans('main.price')}}</th>
                                    <th>{{trans('main.del')}}</th>
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
    <script src="{{ url('/app_js/posEditOrder.js') }}"></script>
    <script>


    </script>
@stop
