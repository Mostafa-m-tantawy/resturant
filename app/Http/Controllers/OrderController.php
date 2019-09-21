<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
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
use App\Systemconf;
use App\Table;
use App\Voiddish;
use function broadcast;
use Illuminate\Http\Request;

//use FCM;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show authenticate waiter order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newOrder()
    {
        $tables = Table::all();
        $dishes =   Dish::whereHas('category.translations', function($q){
            $q->whereNotIn('name',['extras','side dishes']);
        })->get();
    /*dd($dishes);
        $categories = Category::whereHas('translations', function($q){
            $q->whereNotIn('name',['extras','side dishes']);
        })->get();
*/
        $customer=  new Customer;
        return view('user.waiter.order.add-order', [
            'tables' => $tables,
            'dishes' => $dishes,
            'customer'=>$customer,
           // 'categories' => $categories
        ]);
    }
    public function dishAddsPartial($id,$qty)
    {
        $dish =Dish::findOrFail($id);
        if ($dish->dishAdds) {
            return view('user.waiter.order.dish-adds-partial', [
                'dish' => $dish,
                'qty' => $qty
            ]);
        }
    }
    /**
     * Show all order (used in admin / shop manager)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allOrder()
    {
        $orders = Order::where('id', '!=', 0)
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy(function ($data) {
                return $data->created_at->format('M-Y');
            });

        return view('user.admin.order.all-order', [
            'orders' => $orders
        ]);
    }

    /**
     * Non paid order only view for admin and shop manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nonPaidOrder()
    {
        $orders = Order::where('user_id', 0)
            ->orderBy('id', 'desc')
            ->get();
        return view('user.admin.order.non-paid-order', [
            'orders' => $orders
        ]);
    }

    /**
     * Create new order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveOrder(Request $request)
    {
       /// dd($request->get('dishList'));
        $order = new Order();
        $order->order_no = '25142';
        $order->customer_id = $request->get('customer_id');
        $order->table_id = $request->get('table_id');
        $order->payment = $request->get('payment');
        $order->discount = $request->get('discount');
        $order->vat = $request->get('vat') ? $request->get('vat') : 0;
        $order->change_amount = $request->get('change');
        $order->served_by = auth()->user()->id;
        ///

        if ($order->save()) {

            foreach ($request->get('dishList') as $dish) {

                $voids = Voiddish::where('dish_id', $dish['dish_id'])
                    ->where('status', '<>', 'ruind')->where('status', '<>', 'revived')->get();
                    //  ->where('status', '=', 'pending') ???

                /*if($voids->count() >= $dish['quantity'])
                {

for($i=0 ;$i <$dish['quantity'];$i++){
    $void=$voids[$i];
                    $orderDetails = new OrderDetails();
                    $dishType = DishPrice::findOrFail($dish['dish_type_id']);
                    $orderDetails->order_id = $order->id;
                    $orderDetails->dish_id = $dish['dish_id'];
                    $orderDetails->dish_type_id = $dish['dish_type_id'];
                    $orderDetails->quantity = 1;
                    $orderDetails->net_price = $dishType->price;
                    $orderDetails->gross_price = $dishType->price;
          //status 4 void
                    $orderDetails->status=4;
                    $orderDetails->void_id=$void->id;
                        if ($orderDetails->save()) {
                            $void->status='revived';
                            $void->save();
                        }
                }
                }
                else {*/
                $i=0;
                foreach ($voids as $void) {

                    if( $dish['quantity']==$i )
                        break;
                    $i++;
//                if($voids->count() >= $dish['quantity']) {
//                    for ($i = 0; $i < $dish['quantity']; $i++) {
//                        $void = $voids[$i];

                        $orderDetails = new OrderDetails();
                        $dishType = DishPrice::findOrFail($dish['dish_type_id']);
                        $orderDetails->order_id = $order->id;
                        $orderDetails->dish_id = $dish['dish_id'];
                        $orderDetails->dish_type_id = $dish['dish_type_id'];
                        $orderDetails->quantity = 1;
                        $orderDetails->net_price = $dishType->price;
                        $orderDetails->gross_price = $dishType->price;
                        //status 4 void
                        $orderDetails->status = 4;
                        $orderDetails->void_id = $void->id;
                        if ($orderDetails->save()) {
                            $void->status = 'revived';
                            $void->save();

                            if (array_key_exists('dish_adds', $dish)) {
                                foreach ($dish['dish_adds'] as $add_one) {
                                    if ($i == $add_one['index']) {
                                        $order_detail_adds = OrderDetailAdd::where('order_detail_id', $orderDetails->id)
                                            ->where('dish_add_id', $add_one['dish_add_id'])->orderBy('id', 'DESC')->first();

                                        $orderDetailAdds = new OrderDetailAdd();
                                        $orderDetailAdds->order_detail_id = $orderDetails->id;
                                        $orderDetailAdds->type = $add_one['type'];
                                        $orderDetailAdds->index = ($order_detail_adds ? $order_detail_adds->index + $add_one['index'] : $add_one['index']);
                                        $orderDetailAdds->dish_add_id = $add_one['dish_add_id'];
                                        $orderDetailAdds->quantity = $add_one['quantity'];
                                        $orderDetailAdds->net_price = $add_one['net_price'];
                                        $orderDetailAdds->gross_price = $add_one['net_price'];
                                        $orderDetailAdds->dish_id = $add_one['dish_id'];
                                        $orderDetailAdds->dish_type_id = $add_one['dish_type_id'];
                                        //$orderDetailAdds->save();
                                        if ($orderDetailAdds->save()) {
                                            //$add_one['dish_price_id']
                                            $this->addRecipe($add_one['dish_type_id'], $order, $orderDetailAdds);
                                        }
                                    }

                                }
                            }
                        }
                    }
//                }
                if ($voids->count() < $dish['quantity']) {
                    $orderDetails = new OrderDetails();
                    $dishType = DishPrice::findOrFail($dish['dish_type_id']);
                    $orderDetails->order_id = $order->id;
                    $orderDetails->dish_id = $dish['dish_id'];
                    $orderDetails->dish_type_id = $dish['dish_type_id'];
//                    $orderDetails->quantity =  ( $dish['quantity'] );
                    $orderDetails->quantity = ($dish['quantity'] - $voids->count());
                    $orderDetails->net_price = $dishType->price;
//                    $orderDetails->gross_price = ( $dish['quantity'])* $dishType->price;
                    $orderDetails->gross_price = ($dish['quantity'] - $voids->count()) * $dishType->price;
                    if ($orderDetails->save()) {
                        if (array_key_exists('dish_adds',$dish)) {
                            foreach ($dish['dish_adds'] as $add_one) {
                                if ($add_one['index'] > $i) {
                                        $order_detail_adds = OrderDetailAdd::where('order_detail_id', $orderDetails->id)
                                            ->where('dish_add_id', $add_one['dish_add_id'])->orderBy('id', 'DESC')->first();

                                        $orderDetailAdds = new OrderDetailAdd();
                                        $orderDetailAdds->order_detail_id = $orderDetails->id;
                                        $orderDetailAdds->type = $add_one['type'];
                                        $orderDetailAdds->index = ($order_detail_adds ? ($order_detail_adds->index -$i) + $add_one['index'] : $add_one['index']);
                                        $orderDetailAdds->dish_add_id = $add_one['dish_add_id'];
                                        $orderDetailAdds->quantity = $add_one['quantity'];
                                        $orderDetailAdds->net_price = $add_one['net_price'];
                                        $orderDetailAdds->gross_price = $add_one['quantity'] * $add_one['net_price'];
                                        $orderDetailAdds->dish_id = $add_one['dish_id'];
                                        $orderDetailAdds->dish_type_id = $add_one['dish_type_id'];
                                        //$orderDetailAdds->save();
                                        if ($orderDetailAdds->save()) {
                                            //$add_one['dish_price_id']
                                            $this->addRecipe($add_one['dish_type_id'], $order, $orderDetailAdds);
                                        }
                                    }
                                }
                            }


                        foreach ($dishType->recipes as $recipe) {
                            $cookedProduct = new CookedProduct();
                            $cookedProduct->order_id = $order->id;
                            $cookedProduct->product_id = $recipe->product_id;
                            $cookedProduct->quantity = $recipe->unit_needed * $orderDetails->quantity;
                            $cookedProduct->save();

                            //$cart_item['dishprice']['id']
                            //////////$this->addRecipe($dish['dish_type_id'],$order,$orderDetails);

                        }
                        continue;
                    } else {
                        break;
                    }
                }
            }
           // }


            broadcast(new OrderSubmit($order));

            return response()->json($order->id, 200);
        }

    }

    public function addRecipe($dish_price_id,$order,$orderDetails){
        $dishType = DishPrice::findOrFail($dish_price_id);

        foreach ($dishType->recipes as $recipe) {
            $cookedProduct = new CookedProduct();
            $cookedProduct->order_id = $order->id;
            $cookedProduct->product_id = $recipe->product_id;
            $cookedProduct->quantity = $recipe->unit_needed * $orderDetails->quantity;
            $cookedProduct->save();


            /**update dish if nostock**/
            $recipe_product = Product::find($recipe->product_id);
            $total_purses = $recipe_product->purses->sum('quantity');
            $total_cooked = $recipe_product->cookedProducts->sum('quantity');

            $available_product = $total_purses - $total_cooked;
            if ($available_product <= 0) {
                $recipe_dish = Dish::find($recipe->dish_id);
                $recipe_dish->update(['available' => 0]);


                $to_email = Systemconf::where('name', 'MAIL_ADDRESS')->first();
                if ($to_email && $to_email->value != null) {
                    $to_email = $to_email->value;
                }

                else {
                    $to_email = 'info@walemah.com';
                }

                /*  Mail::send('mail.stock-notification', ['title' => 'stock shortage',
                'dish_id' => $recipe_dish->id,
                'dish_name' => $recipe_dish->name

                ], function ($m) use ( $to_email ){
                //  $m->from($request->input('email'), 'Your Application');
                $m->from('info@walemah.com', 'Your Application');
                $m->to( $to_email , 'support')->subject('stock shortage');

                });*/
            }
        }
    }

    /**
     * Edit order
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editOrder($id)
    {
        $order = Order::findOrFail($id);
        $customer = $order->customer; //Customer::find($order->customer_id);
//dd($order);
        $tables = Table::all();
        $dishes = Dish::all();
        $restaurant_vat_percentage = Systemconf::where('name', 'RESTAURANT_VAT_PERCENTAGE')->first()->value;

        return view('user.waiter.order.edit-order', [
            'order' => $order,
            'dishes' => $dishes,
            'tables' => $tables,
            'customer'=>$customer,
            'restaurant_vat_percentage' => $restaurant_vat_percentage
        ]);
    }

    /**
     * View order details
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getOrderDetails($id)
    {
        $order = Order::findOrFail($id);
        return $order->orderDetails;
        return response()->json([$order->orderDetails, $order->orderDetails->product]);
    }


    /**
     * Order of authenticate user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myOrder()
    {
        $orders = Order::whereIn('table_id', auth()->user()->tables->pluck('assignable_id'))->orderBy('id','DESC')->get();
        return view('user.waiter.order.my-order', [
            'orders' => $orders
        ]);
    }

    /**
     * Update order
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request, $id)
    {

        $order = Order::findOrFail($id);
//        OrderDetails::where('order_id',$order->id)->delete();
//        CookedProduct::where('order_id',$order->id)->delete();
        $order->payment = $request->get('payment');
        $order->customer_id = $request->get('customer_id');
        $order->table_id = $request->get('table_id');
        $order->discount = $request->get('discount');
        $order->change_amount = $request->get('change');
        if ($order->save()) {

            foreach ($request->get('dishList') as $dish) {

                if ($dish['id'] == null) {
                    $voids = Voiddish::where('dish_id', $dish['dish_id'])
                        ->where('status', '<>', 'ruind')->where('status', '<>', 'revived')->get();

                    /*if($voids->count() >= $dish['quantity'])
                    {

                        for($i=0 ;$i <$dish['quantity'];$i++){

                            $void=$voids[$i];
                            $orderDetails = new OrderDetails();
                            $dishType = DishPrice::findOrFail($dish['dish_type_id']);
                            $orderDetails->order_id = $order->id;
                            $orderDetails->dish_id = $dish['dish_id'];
                            $orderDetails->dish_type_id = $dish['dish_type_id'];
                            $orderDetails->quantity = '1';
                            $orderDetails->net_price = $dishType->price;
                            $orderDetails->gross_price = $dishType->price;
                            //status 4 void
                            $orderDetails->status=4;
                            $orderDetails->void_id=$void->id;

                            if ($orderDetails->save()) {
                                $void->status='revived';
                                $void->save();

                            }
                        }
                    }
                    else {*/
                    $i = 0;
                    foreach ($voids as $voidd) {
                        if( $dish['quantity']==$i )
                            break;
                        $i++;
                        $orderDetails = new OrderDetails();
                        $dishType = DishPrice::findOrFail($dish['dish_type_id']);
                        $orderDetails->order_id = $order->id;
                        $orderDetails->dish_id = $dish['dish_id'];
                        $orderDetails->dish_type_id = $dish['dish_type_id'];
                        $orderDetails->quantity = 1;//$dish['quantity'];
                        $orderDetails->net_price = $dishType->price;
                        $orderDetails->gross_price = $dishType->price;
                        //status 4 void
                        $orderDetails->status = 4;
                        $orderDetails->void_id = $voidd->id;
                        if ($orderDetails->save()) {
                            $voidd->status = 'revived';
                            $voidd->save();

                            if (array_key_exists('dish_adds',$dish)) {
                                foreach ($dish['dish_adds'] as $add_one) {
                                    if ($i == $add_one['index']) {
                                        $order_detail_adds = OrderDetailAdd::where('order_detail_id', $orderDetails->id)
                                            ->where('dish_add_id', $add_one['dish_add_id'])->orderBy('id', 'DESC')->first();

                                        $orderDetailAdds = new OrderDetailAdd();
                                        $orderDetailAdds->order_detail_id = $orderDetails->id;
                                        $orderDetailAdds->type = $add_one['type'];
                                        $orderDetailAdds->index = ($order_detail_adds ? $order_detail_adds->index + $add_one['index'] : $add_one['index']);
                                        $orderDetailAdds->dish_add_id = $add_one['dish_add_id'];
                                        $orderDetailAdds->quantity = 1;
                                        $orderDetailAdds->net_price = $add_one['net_price'];
                                        $orderDetailAdds->gross_price = $add_one['net_price'];
                                        $orderDetailAdds->dish_id = $add_one['dish_id'];
                                        $orderDetailAdds->dish_type_id = $add_one['dish_type_id'];
                                        //$orderDetailAdds->save();
                                        if ($orderDetailAdds->save()) {
                                            //$add_one['dish_price_id']
                                            $this->addRecipe($add_one['dish_type_id'], $order, $orderDetailAdds);
                                        }
                                    }

                                }
                            }
                        }
                    }
                    if ($voids->count() < $dish['quantity']) {
                        $orderDetails = new OrderDetails();
                        $dishType = DishPrice::findOrFail($dish['dish_type_id']);
                        $orderDetails->order_id = $order->id;
                        $orderDetails->dish_id = $dish['dish_id'];
                        $orderDetails->dish_type_id = $dish['dish_type_id'];
//                    $orderDetails->quantity =  ( $dish['quantity'] );
                        $orderDetails->quantity = ($dish['quantity'] - $voids->count());
                        $orderDetails->net_price = $dishType->price;
//                    $orderDetails->gross_price = ( $dish['quantity'])* $dishType->price;
                        $orderDetails->gross_price = ($dish['quantity'] - $voids->count()) * $dishType->price;
                        if ($orderDetails->save()) {
                            if (array_key_exists('dish_adds',$dish)) {
                                foreach ($dish['dish_adds'] as $add_one) {
                                    if ($add_one['index'] > $i) {
                                        $order_detail_adds = OrderDetailAdd::where('order_detail_id', $orderDetails->id)
                                            ->where('dish_add_id', $add_one['dish_add_id'])->orderBy('id', 'DESC')->first();

                                        $orderDetailAdds = new OrderDetailAdd();
                                        $orderDetailAdds->order_detail_id = $orderDetails->id;
                                        $orderDetailAdds->type = $add_one['type'];
                                        $orderDetailAdds->index = ($order_detail_adds ? ($order_detail_adds->index - $i) + $add_one['index'] : $add_one['index']);
                                        $orderDetailAdds->dish_add_id = $add_one['dish_add_id'];
                                        $orderDetailAdds->quantity = $add_one['quantity'];
                                        $orderDetailAdds->net_price = $add_one['net_price'];
                                        $orderDetailAdds->gross_price = $add_one['quantity'] * $add_one['net_price'];
                                        $orderDetailAdds->dish_id = $add_one['dish_id'];
                                        $orderDetailAdds->dish_type_id = $add_one['dish_type_id'];
                                        //$orderDetailAdds->save();
                                        if ($orderDetailAdds->save()) {
                                            //$add_one['dish_price_id']
                                            $this->addRecipe($add_one['dish_type_id'], $order, $orderDetailAdds);
                                        }
                                    }
                                }
                            }

                            foreach ($dishType->recipes as $recipe) {
                                $cookedProduct = new CookedProduct();
                                $cookedProduct->order_id = $order->id;
                                $cookedProduct->product_id = $recipe->product_id;
                                $cookedProduct->quantity = $recipe->unit_needed * $orderDetails->quantity;
                                $cookedProduct->save();

                                $this->addRecipe($dish['dish_type_id'], $order, $orderDetails);
                            }
                            continue;
                        } else {
                            break;
                        }
                    }

                //}
            }
            else {
                //comment as i think not using update on pre-added dishes (removed order detail edit
                   /* $orderDetails = OrderDetails::find($dish['id']);
                    $dishType = DishPrice::findOrFail($dish['dish_type_id']);
                    $orderDetails->order_id = $order->id;
                    $orderDetails->dish_id = $dish['dish_id'];
                    $orderDetails->dish_type_id = $dish['dish_type_id'];
                    $orderDetails->quantity = $dish['quantity'];
                    $orderDetails->net_price = $dishType->price;
                    $orderDetails->gross_price = $dish['quantity'] * $dishType->price;


                    if ($orderDetails->save()) {
                        foreach ($dishType->recipes as $recipe) {
                            $cookedProduct = new CookedProduct();
                            $cookedProduct->order_id = $order->id;
                            $cookedProduct->product_id = $recipe->product_id;
                            $cookedProduct->quantity = $recipe->unit_needed * $orderDetails->quantity;
                            $cookedProduct->save();

                            $this->addRecipe($dish['dish_type_id'],$order,$orderDetails);
                        }
                        continue;
                    } else {
                        break;
                    }*/
                }

                $order_tablets =  ($order->table? $order->table->tablets->pluck('code')->toArray():[]);
                broadcast(new OrderUpdateApi($order_tablets, $order->id));

            }
            broadcast(new OrderUpdate('Order Update'))->toOthers();
            return response()->json('Ok', 200);
        }

    }

    /**
     * Print order if payment is complete
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('user.admin.order.print-order', [
            'order' => $order
        ]);
    }

    /**
     * Mark order (if order marked, no one can edit/delete this order)
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->user_id = auth()->user()->id;
        if ($order->save()) {
            return response()->json('Ok', 200);
        }

    }

    /**
     * Delete order
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        OrderDetails::where('order_id', $order->id)->delete();
        CookedProduct::where('order_id', $order->id)->delete();
        if ($order->delete()) {
            broadcast(new OrderCancel('orderCancel'))->toOthers();
            return redirect()->back()->with('delete_success', 'The order has been deleted successfully');
        }

    }

    /**
     * Show order of authenticate kitchen
     * @return \Illuminate\Http\JsonResponse
     */
    public function kitchenOrderToJSON()
    {
        $printstations = Auth::user()->printstations;

        $orders = Order::
        where('status', '!=', 2)
            ->with(['orderDetails' => function ($q) use ($printstations) {
                if ($printstations->count() > 0) {
                    foreach ($printstations as $printstation) {
                        $q->whereHas('dish', function ($qi) use ($printstation) {
                            $qi->whereHas('printstations', function ($que) use ($printstation) {
                                $que->where('printstations.id', $printstation->id);
                            });
                        });
                    }
                } else {
                    $q->whereHas('dish', function ($qi) {
                        $qi->whereDoesnthave('printstations');
                    });
                }
                $q->orderBy('updated_at', 'DESC');
            }])
            ->with(['servedBy','table'])
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($orders);
    }

    /**
     * Kitchen takes the dish to cook
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function kitchenStartCooking($id)
    {

        $order = Order::findOrfail($id);
        if ($order->status == 0) {
            $order->status = 1;
//            $order->kitchen_id = auth()->user()->id;
            $order->save();
        }
        $orders = Order::where('kitchen_id', 0)
//            ->orWhere('kitchen_id',auth()->user()->id)
            ->where('status', '!=', 2)
            ->with(['orderDetails' => function ($q) {
                $q->orderBy('updated_at', 'DESC');
            }])
            ->with('servedBy')
            ->orderBy('id', 'desc')
            ->get();
        broadcast(new StartCooking($order))->toOthers();
        //  event(new  StartCooking($order));
        return response()->json($orders);

    }

    /**
     * Kitchen cooked the order
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function kitchenCompleteCooking($id)
    {
        $order = Order::findOrfail($id);
        $order->status = 2;
        $order->save();
        $orders = Order::where('kitchen_id', 0)
//            ->orWhere('kitchen_id',auth()->user()->id)
            ->where('status', '!=', 2)
            ->with(['orderDetails' => function ($q) {
                $q->orderBy('updated_at', 'DESC');
            }])
            ->with('servedBy')
            ->orderBy('id', 'desc')
            ->get();
        ///->toSql();
        ////return $orders;

        broadcast(new CompleteCooking("Complete"))->toOthers();
        return response()->json($orders);
    }

    public function kitchenStartCookingDish($dish_id)
    {
        $printstations = Auth::user()->printstations;


        $dish = OrderDetails::findOrfail($dish_id);

        if ($dish->status == 0) {
            $dish->status = 1;
//            $dish->kitchen_id = auth()->user()->id;
            if ($dish->save()) {
                //if we cook dish from order then make status of order cooking
                $order = Order::findOrfail($dish->order_id);
                $order->status = 1;
                $order->save();
            };
        }

        broadcast(new StartCookingDish($order))->toOthers();
        //  event(new  StartCooking($order));
        return $this->kitchenOrderToJSON();

    }

    /**
     * Kitchen cooked the order
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function kitchenCompleteCookingDish($dish_id)
    {
        $printstations = Auth::user()->printstations;

        $dish = OrderDetails::findOrfail($dish_id);
        $dish->status = 2;
        $dish->save();

        broadcast(new CompleteCookingDish("Complete"))->toOthers();
//        return response()->json($orders);
//        return redirect('kitchen-orders');
        return $this->kitchenOrderToJSON();

    }

    /**
     * Waiter served the order
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function kitchencanceldish(Request $request, $dish_id)
    {
        /// status 3 in oeder_details  is canceld
        $dish = OrderDetails::findOrfail($dish_id);
        $dish->status = 3;
        $dish->report = $request->report;

        if ($dish->save()) {
            for($i=0;$i<$dish->quantity;$i++){
                $void=new Voiddish;
                $void->dish_id=$dish->dish_id;
                $void->status='canceled';
                $void->order_details_id=$dish->id;
                $void->save();
            }

            broadcast(new DishCancel("success"))->toOthers();
            return redirect('live-kitchen-admin-json');
        }
    }

    public function kitchendeletedish($dish_id)
    {
        /// status 3 in order_details  is deleted with report

        $dish = OrderDetails::destroy($dish_id);
        broadcast(new DishCancel("success"))->toOthers();
        return redirect('live-kitchen-admin-json');

    }
    public function kitchencookvoid($dish_id)
    {
        /// status 3 in order_details  is deleted with report

        $dish = OrderDetails::find($dish_id);
        $dish->status=1;
        if ($dish->save()) {
            //if we cook dish from order then make status of order cooking
            $order = Order::findOrfail($dish->order_id);
            $order->status = 1;
            $order->save();

    }

broadcast(new StartCookingDish($order))->toOthers();
        return redirect('live-kitchen-admin-json');

    }
    public function kitchendeletevoid($dish_id)
    {

        $dish = OrderDetails::find($dish_id);
        $void=Voiddish::find($dish->void_id);
        $void->status='ruind';
        $void->save();


        $orderDetails = new OrderDetails();
        $dishType = DishPrice::findOrFail($dish->dish_type_id);
        $orderDetails->order_id = $dish->order_id;
        $orderDetails->dish_id = $dish->dish_id;
        $orderDetails->dish_type_id = $dish->dish_type_id;
        $orderDetails->quantity =  1;
        $orderDetails->net_price = $dishType->price;
        $orderDetails->gross_price =  $dishType->price;
        if ($orderDetails->save()) {

            $orderDetailAdds = OrderDetailAdd::where('order_detail_id',$dish->id);
            $orderDetailAdds->update(['order_detail_id' => $orderDetails->id]);

            foreach ($dishType->recipes as $recipe) {
                $cookedProduct = new CookedProduct();
                $cookedProduct->order_id = $dish->order_id;
                $cookedProduct->product_id = $recipe->product_id;
                $cookedProduct->quantity = $recipe->unit_needed * $orderDetails->quantity;
                $cookedProduct->save();

                //$cart_item['dishprice']['id']
                $order =Order::find($dish->order_id);
                $this->addRecipe($dish->dish_type_id,$order,$orderDetails);
            }
        }
        $dish = OrderDetails::destroy($dish_id);

        broadcast(new DishCancel("success"))->toOthers();
        return redirect('live-kitchen-admin-json');

    }

    public function orderServed($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 3;
        if ($order->save()) {
            broadcast(new OrderServed("success"))->toOthers();
            return response()->json('Ok', 200);
        }
    }

    /**
     * Waiter served the order
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function closeOrder($id)
    {

        $order = Order::findOrFail($id);
        if ($order) {
            $order_tablets = ($order->table ? $order->table->tablets->pluck('code')->toArray() : []);
            $order->status = 4;
            $order->cashier = Auth::user()->id;
            $order->save();
            event(new OrderClosed($order_tablets, $id));
//            event(new OrderClosed(['1234'], $id));

            //event(new OrderClosed(['111']));
            //   dd('done');
        }
        return redirect()->back();

        /*
                $push = new PushNotification('fcm');
                $push->setMessage([
                    'notification' => [
                        'title'=>'This is the title',
                        'body'=>'This is the message',
                        'sound' => 'default'
                    ],
                    'data' => [
                        'extraPayLoad1' => 'value1',
                        'extraPayLoad2' => 'value2'
                    ]
                ])
                    ->setApiKey('Server-API-Key')
                    ->setDevicesToken(['']);
                //->setDevicesToken(['deviceToken1','deviceToken2','deviceToken3'...]);
                  ///  return response()->json('Ok',200);
                */

    }


    public function mergeOrders(Request $request)
    {
        $ordernumbers = explode(',', $request->ordernumbers);
        $baseOrder = array_shift($ordernumbers);
        foreach ($ordernumbers as $ordernumber) {
            OrderDetails::where('order_id', '=', $ordernumber)
                ->update(['order_id' => $baseOrder]);
            Order::destroy($ordernumber);
        }
        broadcast(new OrderUpdate('Order Merged'));
        return redirect()->back();

    }

    public function vatReport(Request $request)
    {
        if ($request->submit) {
        $request->flash();
        $orders = Order::with(['orderDetails','table'])->get();
        return view('user.admin.report.vat')->with(compact('orders'));

    }
        return view('user.admin.report.vat');
    }


}
