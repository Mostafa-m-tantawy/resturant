<?php

namespace App\Http\Controllers;

use App\CookedProduct;
use App\DishSize;
use App\PendingRecipe;
use App\RuinedDish;
use App\RuinedDishDetails;
use App\SystemConf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishRuinedController extends Controller
{
    public function index()
    {
        $ruined = RuinedDish::all();
        return view('frontend.dish.ruined.index')->with(compact('ruined'));
    }


    public function newOrder()
    {

        return view('frontend.dish.ruined.create');
    }

    public function saveOrder(Request $request)
    {
$systemconf=SystemConf::all();
// save Order Header with vat service and if staff
        $restaurant = Auth::user()->restaurant;
        $ruined = new RuinedDish();
        $ruined->restaurant_id = $restaurant->id;
        if ($request->vat == 'on')
            $ruined->vat = $systemconf->where('name','vat')->first()->value;
        if ($request->staff == 'on')
            $ruined->is_staff = 1;

        if ($ruined->save()) {
            /***** save order details or dishes     *****/
            foreach (json_decode($request->get('purses')) as $purse) {

                $dish = $purse->dish;
                $DishSize = DishSize::find($dish->dishId);

                $ruinedDetails = new RuinedDishDetails();
                $ruinedDetails->ruined_dish_id = $ruined->id;
                $ruinedDetails->dish_size_id = $dish->dishId;
                $ruinedDetails->unit_price = $DishSize->price;
                $ruinedDetails->quantity = $purse->quantity;

                /***** save recipes  in cooked product  *****/

                if ($ruinedDetails->save()) {
                    $recipes = $DishSize->recipes;
                    foreach ($recipes as $recipe) {
                        $cookedProduct = new CookedProduct();
                        $cookedProduct->restaurant_id = $restaurant->id;
                        $cookedProduct->order_details_id = $ruinedDetails->id;
                        $cookedProduct->dish_size_id = $DishSize->id;
                        $cookedProduct->product_id = $recipe->product->id;
                        $cookedProduct->quantity = $recipe->unit_quantity * $ruinedDetails->quantity;
                        $cookedProduct->save();
                    }
                } else {
                    RuinedDishDetails::where('ruined_dish_id', $ruined->id)->delete();
                    RuinedDish::destroy($ruined->id);
                    return response()->json('Internal Serer Error', 422);
                }
                PendingRecipe::destroy($purse->id);

            }
            return response()->json($request->all(), 200);
        } else {
            return response()->json('Internal Server Error', 422);
        }
    }
//
//    public function edit($id)
//    {
//        $order = Order::with(['orderDetails' => function ($q) {
//            $q->with(['dishSize' => function ($qq) {
//                $qq->with(['dish']);
//            }]);
//        }])->find($id);
//        return view('frontend.order.edit-order')->with(compact('order'));
//    }
//
//    public function editJson($id)
//    {
//        $order = Order::with(['orderDetails' => function ($q) {
//            $q->with(['dishSize' => function ($qq) {
//                $qq->with(['dish']);
//            }]);
//        }])->find($id);
//
//        return \response()->json($order, 200);
//    }
//
//
//    public function update(Request $request)
//    {
//
//// save Order Header with vat service and if staff
//        $restaurant = Auth::user()->restaurant;
//        $order = Order::find($request->get('order_id'));
//        $order->discount = $request->get('discount');
//
//        if ($request->vat == 'on')
//            $order->vat = 14;
//        if ($request->service == 'on')
//            $order->service = 12;
//        if ($request->staff == 'on')
//            $order->is_staff = 1;
//
//        if ($order->save()) {
//            /***** save order details or dishes     *****/
//            foreach (json_decode($request->get('purses')) as $purse) {
//
//                $dish = $purse->dish;
//                $DishSize = DishSize::find($dish->dishId);
//                if ($purse->oldId == '') {
//                    $orderDetails = new OrderDetails();
//                    $orderDetails->order_id = $order->id;
//                    $orderDetails->dish_size_id = $dish->dishId;
//                    $orderDetails->unit_price = $DishSize->price;
//                    $orderDetails->quantity = $purse->quantity;
//
//                    /***** save recipes  in cooked product  *****/
//
//                    if ($orderDetails->save()) {
//                        $recipes = $DishSize->recipes;
//                        foreach ($recipes as $recipe) {
//                            $cookedProduct = new CookedProduct();
//                            $cookedProduct->restaurant_id = $restaurant->id;
//                            $cookedProduct->order_details_id = $orderDetails->id;
//                            $cookedProduct->dish_size_id = $DishSize->id;
//                            $cookedProduct->product_id = $recipe->product->id;
//                            $cookedProduct->quantity = $recipe->unit_quantity * $orderDetails->quantity;
//                            $cookedProduct->save();
//                        }
//                    } else {
//                        OrderDetails::where('order_id', $order->id)->delete();
//                        $order::destroy($purse->id);
//                        return response()->json('Internal Serer Error', 422);
//                    }
//
//                    PendingRecipe::destroy($purse->id);
//                } else {
//                    if ($purse->deleted == true) {
//                        OrderDetails::destroy($purse->oldId);
//                        CookedProduct::where('order_details_id', $purse->oldId)->delete();
//                    }
//                }
//            }
//
//            return response()->json($request->all(), 200);
//        } else {
//            return response()->json('Internal Server Error', 422);
//        }
//    }

    public function delete($id)
    {
        Order::destroy($id);
        return redirect(route('order.index'));

    }
}
