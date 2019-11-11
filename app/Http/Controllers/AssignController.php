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

    public function index(){
        $assigns=AssignStock::all();
        return view('frontend.assign.index')->with(compact('assigns'));
    }
    public function CreateAssign()
    {
        $restaurant = Auth::user()->restaurant;

        return view('frontend.assign.create-assign')->with(compact('restaurant'));

    }

    public function getSource($type)
    {
        if ($type == 'restaurant') {
            $restaurant =Auth::user()->restaurant;
              return response()->json($restaurant, 200);
          }
        elseif ($type == 'department') {
            $departments=Department::where('restaurant_id', Auth::user()->restaurant->id)->get();

            if($departments->count()>0)
                return response()->json($departments, 200);
            else
                return response()->json('false', 422);
        }

    }
    public function getSourceProducts(Request $request)
    {
        if ($request->type == 'restaurant') {
            $products =Auth::user()->restaurant->products;
            $departments=Auth::user()->restaurant->departments;
            if($products->count()>0)
                return response()->json([$products,$departments], 200);
            else
                return response()->json('false', 422);
        }
        elseif ($request->type == 'department') {
            $department=Department::find($request->id);
            $restaurant =Auth::user()->restaurant;

            $products=$department->products;
            if($products->count()>0)
                return response()->json([$products,[$restaurant]], 200);
            else
                return response()->json('false', 422);
        }

    }


    public function saveAssign(Request $request)

    {
        $assign = new AssignStock();

	    $assign->restaurant_id=Auth::user()->restaurant->id;
		$assign->sourceable_id	    = $request->source_id;
		$assign->sourceable_type	= ($request->source_type=='restaurant')?'App\Restaurant':'App\Department';
		$assign->assignable_id	    = $request->assign_to;
		$assign->assignable_type    =($request->source_type=='restaurant')?'App\Department':'App\Restaurant';
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
