<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class lifeKitchenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:life kitchen'],['only'=>['lifeKitchen']]);
    }


    public function lifeKitchen(Request $request)
    {

        return view('pos.kitchen.life_kitchen');

    }
        public function lifeKitchenJson(Request $request){
        $orders=Order::where('status','<>','closed')->with(['orderDetails' => function ($q) {
            $q->with(['dishSize' => function ($qq) {
                $qq->with(['dish']);
            }])->with(['sides', 'extras'])->where('type', null);
        }])->get();

        return response()->json($orders,200);
    }
}
