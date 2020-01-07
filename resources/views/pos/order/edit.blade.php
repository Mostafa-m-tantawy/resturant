@extends('.pos.layout.pos_app')

@section('title')
    {{trans('main.create order')}}
@stop



@section('content')
    <link href="{{asset('/css/easy-numpad.css')}}" rel="stylesheet" type="text/css"/>

    <meta name="service" content="  {{$systemconf->where('name','service')->first()->value}}">
    <meta name="vat" content="{{$systemconf->where('name','vat')->first()->value}}">
    <meta name="type" content="{{$order->type}}">
    <meta name="order_id" content="{{$order->id}}">
    <meta name="status" content="{{$order->status}}">




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
                                                                         src="{{asset($dish->image)}}"
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
                                    <th style="text-align: center;">{{trans('main.price')}}</th>
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
    <div class="modal fade payment_modal" id="payment_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('main.payment')}} <span class="name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <form id="payment" method="post" action="{{route('order-payment.store')}}">
                                <div class="row">
                                    <div class="col-12">
                                        <h4> {{trans('main.demand')}} = {{$order->demand}}</h4>

                                    </div>
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">

                                    <div class="form-group col-12">
                                        <label for="inputPassword4"
                                               class="control-label">{{trans('main.payment method')}}</label>
                                        <select class="form-control" onchange=" methodChange()"
                                                id="payment_method" name="payment_method">
                                            <option
                                                value="">{{ trans('main.select') }} {{ trans('main.payment') }} </option>
                                            <option value="cash">{{ trans('main.cash') }} </option>
                                            <option value="check">{{ trans('main.check') }} </option>
                                            <option value="creditcard">{{ trans('main.creditcard') }} </option>
                                            <option value="account">{{ trans('main.account') }} </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-12" id="clientDiv" style="display:none;">
                                        <label
                                            class=" control-label">  {{ trans('main.client') }}</label>
                                        <select class="form-control" id="client_id" name="client_id" onchange="clientChange()">
                                            <option data-money="0" value="">
                                                {{ trans('main.select') }} {{ trans('main.client') }}
                                            </option>

                                            @foreach($clients as $client)
                                                <option data-money="{{$client->hisMoney}}" value="{{$client->id}}">
                                                    {{ $client->name .' - '.$client->phone1}}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group col-12">
                                        <label
                                            class=" control-label">  {{ trans('main.amount') }}</label>
                                        <input type="number" required name="amount" max="1000000000"
                                               class="form-control" step="0.001" min="0"  id="easy-numpad-output">

                                    </div>
                                    <div class="form-group col-12">
                                        <label class=" control-label">{{ trans('main.note') }}</label>
                                        <input type="text" name="note" class="form-control" id="note">

                                    </div>
                                    <div class="form-group col-12">
                                        <label class=control-label">{{ trans('main.files') }} :</label>
                                        <input type="file" name="files[]" multiple class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 pull-left">
                                    <button class="btn btn-primary">
                                        {{trans('main.pay')}}
                                    </button>
                                </div>
                            </form>

                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">


                                    <div class="easy-numpad-frame" id="easy-numpad-frame">
                                        <div class="easy-numpad-container">

                                            <div class="easy-numpad-number-container">


                                                <table>
                                                    <tr>
                                                        <td><a href="7" onclick="easynum()">7</a></td>
                                                        <td><a href="8" onclick="easynum()">8</a></td>
                                                        <td><a href="9" onclick="easynum()">9</a></td>
                                                        <td><a href="Del" class="del" id="del"
                                                               onclick="easy_numpad_del()">Del</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="4" onclick="easynum()">4</a></td>
                                                        <td><a href="5" onclick="easynum()">5</a></td>
                                                        <td><a href="6" onclick="easynum()">6</a></td>
                                                        <td><a href="Clear" class="clear" id="clear"
                                                               onclick="easy_numpad_clear()">Clear</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="1" onclick="easynum()">1</a></td>
                                                        <td><a href="2" onclick="easynum()">2</a></td>
                                                        <td><a href="3" onclick="easynum()">3</a></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" onclick="easynum()"><a href="0">0</a></td>
                                                        <td onclick="easynum()"><a href=".">.</a></td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>{{trans('main.id')}}</th>
                                                    <th>{{trans('main.amount')}}</th>
                                                    <th>{{trans('main.method')}}</th>
                                                    <th>{{trans('main.account')}}</th>
                                                    <th>{{trans('main.delete')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($payments as $payment)
                                                    <tr>
                                                        <td>{{$payment->id}}</td>
                                                        <td>{{$payment->amount}}</td>
                                                        <td>{{$payment->method}}</td>
                                                        <td>{{$payment->client_id}}</td>
                                                        <td>
                                                            @if($order->status!='closed')
                                                                <form method="post"
                                                                      onsubmit="deleteConfirm(event,'{{trans('main.payment')}}')"
                                                                      action="{{route('order-payment.destroy',[$payment->id])}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button
                                                                        class="btn btn-danger"> {{trans('main.delete')}}</button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
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
        </div>
    </div>

@stop


@section('scripts')

    <script src="{{ url('/app_js/posEditOrder.js') }}"></script>
    <script src="{{ url('/app_js/easy-numpad.js') }}"></script>
    <script src="{{ url('/app_js/payment.js') }}"></script>



    <script type="text/javascript">


    </script>
@stop
