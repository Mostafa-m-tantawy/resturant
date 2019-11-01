<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\DishCategory;
use App\DishSize;
use App\Events\CompleteCooking;
use App\Events\CompleteCookingDish;
use App\Events\DishCancel;
use App\Events\OrderCancel;
use App\Events\OrderClosed;
use App\Events\OrderServed;
use App\Events\OrderSubmit;
use App\Events\OrderUpdate;
use App\Events\OrderUpdateApi;
use App\Events\StartCooking;
use App\CookedProduct;
use App\Dish;
use App\DishPrice;
use App\DishType;
use App\Events\StartCookingDish;
use App\Order;
use App\OrderDetailAdd;
use App\OrderDetails;
use App\PendingRecipe;
use App\Systemconf;
use App\Table;
use App\Voiddish;
use http\Env\Response;
use function broadcast;
use Illuminate\Http\Request;

//use FCM;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('frontend.order.index')->with(compact('orders'));
    }

    public function newOrder()
    {

        // only if one user
            PendingRecipe::truncate();


        return view('frontend.order.create-order');
    }


    public function allDeletePending(Request $request)
    {

        foreach (json_decode($request->get('purses')) as $purse) {
            PendingRecipe::destroy($purse->id);
        }
        return response()->json('ok', 200);

    }

    public function DishDeletePending(Request $request)
    {

        PendingRecipe::destroy(explode(",", $request->id));

        return response()->json('ok', 200);

    }


    public function dishAvailableUnits(Request $request)
    {
        $dishSize = DishSize::find($request->get('dish_size_id'));

        $recipes = $dishSize->recipes;
        $quantities = [];
        foreach ($recipes as $recipe) {
            $departmentQuantity = $recipe->product->departmentquantity('department', $dishSize->dish->department_id);

            $pendingQuantity = PendingRecipe::where('product_id', $recipe->product->id)->sum('quantity');//   $recipe->product->departmentquantity('department',$this->dish->department_id)

            $quantities[] = ($departmentQuantity - $pendingQuantity) / $recipe->unit_quantity;;
        }
        if (count($quantities) > 0 && (min($quantities) - $request->get('quantity')) > 0) {
            $ids = [];
            foreach ($recipes as $recipe) {

                $pending = new PendingRecipe();
                $pending->restaurant_id = Auth::user()->restaurant->id;
                $pending->dish_size_id = $request->get('dish_size_id');
                $pending->product_id = $recipe->product->id;
                $pending->quantity = $recipe->unit_quantity * $request->get('quantity');
                $pending->save();

                $ids[] = $pending->id;
            }


            return response()->json($ids, 200);
        } else {
            return response()->json(min($quantities), 422);
        }

    }


    public function saveOrder(Request $request)
    {
        $systemconf=SystemConf::all();

// save Order Header with vat service and if staff
        $restaurant = Auth::user()->restaurant;
        $order = new Order();
        $order->restaurant_id = $restaurant->id;
        $order->discount = $request->discount;

        if ($request->vat == 'on')
            $order->vat = $systemconf->where('name','vat')->first()->value;

        if ($request->service == 'on')
            $order->service =  $systemconf->where('name','service')->first()->value;
        if ($request->staff == 'on')
            $order->is_staff = 1;
        else
            $order->is_staff = 0;

        if ($order->save()) {
            /***** save order details or dishes     *****/
            foreach (json_decode($request->get('purses')) as $purse) {

                $dish = $purse->dish;
                $DishSize = DishSize::find($dish->dishId);

                $orderDetails = new OrderDetails();
                $orderDetails->order_id = $order->id;
                $orderDetails->dish_size_id = $dish->dishId;
                $orderDetails->unit_price = $dish->price;
                $orderDetails->unit_cost = $dish->cost;
                $orderDetails->quantity = $purse->quantity;

                /***** save recipes  in cooked product  *****/

                if ($orderDetails->save()) {
                    $recipes = $DishSize->recipes;
                    foreach ($recipes as $recipe) {
                        $cookedProduct = new CookedProduct();
                        $cookedProduct->restaurant_id = $restaurant->id;
                        $cookedProduct->order_details_id = $orderDetails->id;
                        $cookedProduct->dish_size_id = $DishSize->id;
                        $cookedProduct->product_id = $recipe->product->id;
                        $cookedProduct->quantity = $recipe->unit_quantity * $orderDetails->quantity;
                        $cookedProduct->save();
                    }
                } else {
                    OrderDetails::where('order_id', $order->id)->delete();
                    $order::destroy($purse->id);
                    return response()->json('Internal Serer Error', 422);
                }

                PendingRecipe::destroy($purse->id);

            }
            return response()->json($request->all(), 200);
        } else {
            return response()->json('Internal Server Error', 422);
        }
    }

    public function edit($id)
    {
        $order = Order::with(['orderDetails' => function ($q) {
            $q->with(['dishSize' => function ($qq) {
                $qq->with(['dish']);
            }]);
        }])->find($id);
        return view('frontend.order.edit-order')->with(compact('order'));
    }

    public function editJson($id)
    {
        $order = Order::with(['orderDetails' => function ($q) {
            $q->with(['dishSize' => function ($qq) {
                $qq->with(['dish']);
            }]);
        }])->find($id);

        return \response()->json($order, 200);
    }


    public function update(Request $request)
    {
        $systemconf=SystemConf::all();

// save Order Header with vat service and if staff
        $restaurant = Auth::user()->restaurant;
        $order = Order::find($request->get('order_id'));
        $order->discount = $request->get('discount');

        if ($request->vat == 'on')
            $order->vat = $systemconf->where('name','vat')->first()->value;

        if ($request->service == 'on')
            $order->service =  $systemconf->where('name','service')->first()->value;
        if ($request->staff == 'on')
            $order->is_staff = 1;
        else
            $order->is_staff = 0;
        if ($order->save()) {
            /***** save order details or dishes     *****/
            foreach (json_decode($request->get('purses')) as $purse) {

                $dish = $purse->dish;
                $DishSize = DishSize::find($dish->dishId);
                if ($purse->oldId == '') {
                    $orderDetails = new OrderDetails();
                    $orderDetails->order_id = $order->id;
                    $orderDetails->dish_size_id = $dish->dishId;
                    $orderDetails->unit_price = $dish->price;
                    $orderDetails->unit_cost = $dish->cost;
                    $orderDetails->quantity = $purse->quantity;

                    /***** save recipes  in cooked product  *****/

                    if ($orderDetails->save()) {
                        $recipes = $DishSize->recipes;
                        foreach ($recipes as $recipe) {
                            $cookedProduct = new CookedProduct();
                            $cookedProduct->restaurant_id = $restaurant->id;
                            $cookedProduct->order_details_id = $orderDetails->id;
                            $cookedProduct->dish_size_id = $DishSize->id;
                            $cookedProduct->product_id = $recipe->product->id;
                            $cookedProduct->quantity = $recipe->unit_quantity * $orderDetails->quantity;
                            $cookedProduct->save();
                        }
                    } else {
                        OrderDetails::where('order_id', $order->id)->delete();
                        $order::destroy($purse->id);
                        return response()->json('Internal Serer Error', 422);
                    }

                    PendingRecipe::destroy($purse->id);
                } else {

                    $orderDetails =  OrderDetails::find($purse->oldId);
                    $orderDetails->unit_price = $dish->price;
                    $orderDetails->save();
                    if ($purse->deleted == true) {
                        OrderDetails::destroy($purse->oldId);
                        CookedProduct::where('order_details_id', $purse->oldId)->delete();
                    }
                }
            }

            return response()->json($request->all(), 200);
        } else {
            return response()->json('Internal Server Error', 422);
        }
    }

    public function delete($id)
    {
        OrderDetails::where('order_id',$id)->delete();
        Order::destroy($id);
        return redirect(route('order.index'));

    }


    public function costOrder()
    {
        $orders = Order::all();
        return view('frontend.order.cost_index')->with(compact('orders'));

    }
}
