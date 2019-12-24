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


    <table style="font-size: 2em; width: 100%;">

        <tr>
            <td class="item">{{ trans('main.order') }} </td>
            <td class="price">{{$order->id}}</td>
        </tr>

    </table>
    <br>
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
</div>
</body>
</html>
