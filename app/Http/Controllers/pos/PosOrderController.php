<?php

namespace App\Http\Controllers;

use App\Dish;
use App\DishCategory;
use App\DishSize;
use App\Order;
use App\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allorders = Order::orderByDesc('created_at')->get()->groupBy(function ($item) {
            return $item->created_at->format('d-M-y');
        });
        return view('pos.order.index')->with(compact('allorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = DishCategory::all();
        $type = $request->type;
        return view('pos.order.create')->with(compact('categories', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;

        $order->restaurant_id = Auth::user()->restaurant->id;
        $order->discount = $request->discount;
        $order->vat = $request->vat;
        $order->service = $request->service;
        $order->is_staff = $request->is_staff;
        $order->type = $request->type;


        if ($order->save()) {
            foreach (json_decode($request->get('order')) as $orderDish) {
                $size = $orderDish->size;
                $extras = $orderDish->extras;
                $sides = $orderDish->sides;

                $order_details = new OrderDetails;
                $order_details->order_id = $order->id;
                $order_details->dish_size_id = $size->id;
                $order_details->unit_cost = $size->cost;
                $order_details->unit_price = $size->price;
                $order_details->quantity = $orderDish->quantity;

                if ($order_details->save()) {

                    foreach ($sides as $sideDish) {

                        $side = new OrderDetails;
                        $side->order_id = $order->id;

                        $side->dish_size_id = $sideDish->side_size->id;
                        $side->unit_cost = $sideDish->side_size->cost;
                        $side->unit_price = $sideDish->side_size->price;
                        $side->quantity = $orderDish->quantity;

                        $side->parent_id = $order_details->id;
                        $side->type = 'side';
                        $side->save();
                    }
                    foreach ($extras as $extraDish) {

                        $extra = new OrderDetails;
                        $extra->order_id = $order->id;

                        $extra->dish_size_id = $extraDish->extra_size->id;
                        $extra->unit_cost = $extraDish->extra_size->cost;
                        $extra->unit_price = $extraDish->extra_size->price;
                        $extra->quantity = $orderDish->quantity;

                        $extra->parent_id = $order_details->id;
                        $extra->type = 'extra';
                        $extra->save();
                    }

                } else {
                    OrderDetails::where('order_id', $order->id)->delete();
                    Order::destroy($order->id);
                    return response()->json('Internal Serer Error', 500);
                }
            }

        }
        return response()->json('ok', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     $categories = DishCategory::all();
//
        $order=Order::find($id);
        $order_id=$id;
        $type=$order->type;

        return view('pos.order.edit')->with(compact('categories','order_id','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $order =  Order::find($id);

        $order->discount = $request->discount;
        $order->vat = $request->vat;
        $order->service = $request->service;
        $order->is_staff = $request->is_staff;


        if ($order->save()) {
            foreach (json_decode($request->get('order')) as $orderDish) {
                $size = $orderDish->size;
                $extras = $orderDish->extras;
                $sides = $orderDish->sides;
            if($orderDish->id=='' )
            {   $order_details = new OrderDetails;
                $order_details->order_id = $order->id;
                $order_details->dish_size_id = $size->id;
                $order_details->unit_cost = $size->cost;
                $order_details->unit_price = $size->price;
                $order_details->quantity = $orderDish->quantity;

                if ($order_details->save()) {

                    foreach ($sides as $sideDish) {

                        $side = new OrderDetails;
                        $side->order_id = $order->id;

                        $side->dish_size_id = $sideDish->side_size->id;
                        $side->unit_cost = $sideDish->side_size->cost;
                        $side->unit_price = $sideDish->side_size->price;
                        $side->quantity = $orderDish->quantity;

                        $side->parent_id = $order_details->id;
                        $side->type = 'side';
                        $side->save();
                    }
                    foreach ($extras as $extraDish) {

                        $extra = new OrderDetails;
                        $extra->order_id = $order->id;

                        $extra->dish_size_id = $extraDish->extra_size->id;
                        $extra->unit_cost = $extraDish->extra_size->cost;
                        $extra->unit_price = $extraDish->extra_size->price;
                        $extra->quantity = $orderDish->quantity;

                        $extra->parent_id = $order_details->id;
                        $extra->type = 'extra';
                        $extra->save();
                    }
                } else {
                    OrderDetails::where('order_id', $order->id)->delete();
                    Order::destroy($order->id);
                    return response()->json('Internal Serer Error', 500);
                }
            }elseif($orderDish->deleted){

                OrderDetails::where('parent_id', $orderDish->id)->delete();
                OrderDetails::where('id', $orderDish->id)->delete();

            }
            }


        }
        return response()->json('ok', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allDishes()
    {
        $dishes = Dish::where('status', '1')->with(['sizes' => function ($q) {
            $q->where('status', '1')
                ->with(['sides' => function ($qq) {
                    $qq->with(['sideSize' => function ($qqq) {
                        $qqq->with('dish');
                    }]);
                }])->with(['extras' => function ($qq) {
                    $qq->with(['extraSize' => function ($qqq) {
                        $qqq->with('dish');
                    }]);
                }]);
        }])->get();

        return response()->json($dishes, 200);
    }


    public function getOrder(Request $request)
    {

        $order =  $order = Order::with(['orderDetails' => function ($q) {
            $q->with(['dishSize' => function ($qq) {
                $qq->with(['dish']);
            }])->with(['sides','extras'])->where('type',null);
        }])->find($request->order_id);


        $dishes = Dish::where('status', '1')->with(['sizes' => function ($q) {
            $q->where('status', '1')
                ->with(['sides' => function ($qq) {
                    $qq->with(['sideSize' => function ($qqq) {
                        $qqq->with('dish');
                    }]);
                }])->with(['extras' => function ($qq) {
                    $qq->with(['extraSize' => function ($qqq) {
                        $qqq->with('dish');
                    }]);
                }]);
        }])->get();

        return response()->json(['dishes'=>$dishes,'order'=>$order], 200);
    }


}
