<?php

namespace App\Http\Controllers;

use App\AssignStock;
use App\AssignStockDetails;
use App\Department;
use App\Product;
use App\Restaurant;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignController extends Controller
{

    public function CreateAssign()
    {

        $restaurant = Auth::user()->restaurant;
        $products=Product::
        whereHas('purchasedProduct',function ($q)use ($restaurant){
            $q->whereHas('purse',function ($qq)use($restaurant){
                $qq->where('restaurant_id',$restaurant->id);
            });
        })->get();
//        dd($products[0]->quantityavailable);
        return view('frontend.assign.create-assign')->with(compact('restaurant','products'));

    }

    public function getAssignable($type)
    {
        if ($type == 'branch') {
            $branches = Restaurant::where('parent_id', Auth::user()->id)->with('user')->get();

          if($branches->count()>0)
              return response()->json($branches, 200);
            else
                return response()->json('false', 422);
        }
        elseif ($type == 'department') {
            $departments=Department::where('restaurant_id', Auth::user()->restaurant->id)->get();

            if($departments->count()>0)
                return response()->json($departments, 200);
            else
                return response()->json('false', 422);
        }

    }
    public function saveAssign(Request $request)

    {
        $assign = new AssignStock();

	    $assign->restaurant_id=Auth::user()->restaurant->id;
		$assign->assignable_id	= $request->assign_to;
		$assign->assignable_type=($request->assign_type=='branch')?'App\Restaurant':'App\Department';
		if($assign->save()){

            foreach (json_decode($request->get('purses')) as $purse) {

                $product = $purse->product;

                $assign_details = new AssignStockDetails();
                $assign_details->assign_stock_id = $assign->id;
                $assign_details->product_id = $product->productId;
                $assign_details->quantity = $purse->quantity;
                $assign_details->save();
            }
        }

        return response()->json('Ok',200);



    }
}
