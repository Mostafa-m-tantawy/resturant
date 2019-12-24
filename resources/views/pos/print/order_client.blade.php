<!DOCTYPE html>
<html lang="ar">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        table.with-border th, table.with-border td {
            border: 1px solid grey;
        }

        body {
            font-family: DejaVu Sans;
            direction: {{(App::getLocale() ==  'en') ? 'ltr':'rtl'}};
        }

        .item{
            text-align: {{(App::getLocale() ==  'en') ? 'left':'right'}};
            float: {{(App::getLocale() ==  'en') ? 'left':'right'}};
        }
        .size{
            text-align: {{(App::getLocale() ==  'en') ? 'left':'right'}};
          }
        .quantity{
            text-align: center;
        }
        .price{
            text-align: {{(App::getLocale() ==  'en') ? 'right':'left'}};
            float: {{(App::getLocale() ==  'en') ? 'right':'left'}};
        }

    </style>
</head>


<body >
<div class="" id="printNow" style="text-align: center ; font-size: 2.5em; height: 100%;width: 100%;">

    <img src="{{asset('/media/icons/pos/full.png')}}" style="max-width:10rem;max-height:10rem;">

   <table style="font-size: 2em; width: 100%;">
    <tr>
        <td class="quantity" colspan="2">Restaurant</td>
    </tr>
       <tr>
        <td class="item">{{ trans('main.phone') }} </td>
        <td class="price">01025232862</td>
    </tr>
       <tr>
        <td class="item">vat reg</td>
        <td class="price">12548963</td>
    </tr>
       <tr>
        <td class="quantity" colspan="2">{{date('Y-m-d h:i:s')}}</td>

    </tr>
   </table>
<br>
<br>
    {{--{{dd($printed_dishes)}}--}}
    <table class="table" style=" font-size: 2em; width: 100%">
        <thead>
        <tr>
            <th class="item" colspan="2">{{ trans('main.item') }}</th>
            <th class="size" >{{ 'size' }}</th>
            <th class="quantity" >{{ '#' }}</th>
            <th class="price" >{{ trans('main.price') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->orderDetails as $orderDetail)

            <tr style="text-decoration:line-through;">
                <td class="item" colspan="2">{{$orderDetail->dishSize->dish->name}}  </td>
                <td  class="size" >{{$orderDetail->dishSize->name}}  </td>
                <td class="quantity" >{{$orderDetail->quantity}} </td>
                @if($order->is_staff)
                    <td class="price" > {{ $orderDetail->unit_cost * $orderDetail->quantity}} </td>
                @else
                    <td class="price" > {{ $orderDetail->unit_price * $orderDetail->quantity}} </td>
                @endif
            </tr>
            @foreach($orderDetail->sides as $side)
                <tr style="text-decoration:line-through;">
                    <td class="item" colspan="2">&nbsp;&nbsp;&nbsp;{{$side->dishSize->dish->name}}  </td>
                    <td class="size">{{$side->dishSize->name}}  </td>
                    <td class="quantity">{{$side->quantity}} </td>
                    <td class="price"   ></td>
            @endforeach
            @foreach($orderDetail->extras as $extra)
                <tr style="text-decoration:line-through;">
                    <td class="item" colspan="2">&nbsp;&nbsp;&nbsp;{{$extra->dishSize->dish->name}}  </td>
                    <td class="size">{{$extra->dishSize->name}}  </td>
                    <td class="quantity" >{{$extra->quantity}} </td>
                    @if($order->is_staff)
                        <td class="price" > {{ $extra->unit_cost * $extra->quantity}} </td>
                    @else
                        <td class="price" > {{ $extra->unit_price * $extra->quantity}} </td>
                @endif
            @endforeach

        @endforeach
        </tbody>
    </table>
            <hr>
    <br>
    <br>
    <table class="table" style=" font-size: 2em; width: 100%">
        <tbody>
        <tr>
            <td class="item">{{ trans('main.sub total') }} </td>
            <th class="price"> {{number_format($order->SupTotal,2)}}</th>
        </tr>
        @if($order->service )
            <tr>
                <td class="item">
                    <span>{{ trans('main.service') }}</span>
                    <span>{{ $order->getOriginal('service')*100 .'%' }}</span></td>
                <th class="price"> {{number_format($order->service,2)}}       </th>
            </tr>
        @endif
        <tr>
            <td class="item">
                <span>{{ trans('main.vat') }} </span>
                <span>{{ $order->getOriginal('vat')*100 .'%' }}</span>
            </td>
            <th class="price"> {{number_format($order->vat,2)}} </th>
        </tr>

        @if($order->discount)
            <tr>
                <td class="item">{{ trans('main.discount') }} </td>
                <th class="price"> {{number_format($order->discount,2)}} </th>
            </tr>
        @endif
        @if($order->coupon)
            <tr>
                <td class="item">
                    <span>{{ trans('main.coupon') }}</span>
                    <span>{{ $order->coupon*100 .'%' }}</span>
                </td>
                <th class="price"> {{number_format($order->CouponValue,2)}} </th>
            </tr>
        @endif
        <tr>
            <td class="item"> {{ trans('main.total') }} :</td>
            <th class="price"> {{number_format($order->gross_total,2)}} </th>
        </tr>

        </tbody>
    </table>
</div>
</body>
</html>
