<?php

namespace App\Http\Controllers;

use App\Department;
use App\Product;
use App\RefundProduct;
use App\Restaurant;
use App\RuinedHeader;
use App\RuinedProduct;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuinedController extends Controller
{

    public function index()
    {
        $ruineds = RuinedProduct::all();

        return view('frontend.ruined.index', [
            'ruineds' => $ruineds
        ]);
    }

    public function newRuined()
    {
        return view('frontend.ruined.new_ruined');
    }

    public function getAssignable($from)
    {
        if ($from == 'restaurant') {
            $branches = Restaurant::where('parent_id', Auth::user()->id)
                ->orWhere('user_id', Auth::user()->id)
                ->with('user')
                ->get();

            if ($branches->count() > 0)
                return response()->json($branches, 200);
            else
                return response()->json('false', 422);
        } elseif ($from == 'department') {
            $departments = Department::where('restaurant_id', Auth::user()->restaurant->id)->get();

            if ($departments->count() > 0)
                return response()->json($departments, 200);
            else
                return response()->json('false', 422);
        }

    }

    public function ruinedProducts(Request $request)
    {
        $type = $request->type;
        $from = $request->from;

        if ($type == 'restaurant') {
            $restaurant = Restaurant::find($from);

            $products = Product::
            whereHas('purchasedProduct', function ($q) use ($restaurant) {
                $q->whereHas('purse', function ($qq) use ($restaurant) {
                    $qq->where('restaurant_id', $restaurant->id);
                });
            })->OrWhereHas('assignDetails', function ($q) use ($restaurant) {
                $q->whereHas('assignHeader', function ($qq) use ($restaurant) {
                    $qq->where('assignable_id', Auth::user()->restaurant->id)->where('assignable_type', 'App\Restaurant');
                });
            })->get();
            if ($products->count() > 0)
                return response()->json($products, 200);
            else
                return response()->json('false', 422);
        }
        elseif($type == 'department'){
        $department=Department::find($from);
            $products = Product::
           OrWhereHas('assignDetails', function ($q) use ($department) {
                $q->whereHas('assignHeader', function ($qq) use ($department) {
                    $qq->where('assignable_id',$department->id)->where('assignable_type', 'App\Department');
                });
            })->get();
//dd($products);
            if ($products->count() > 0)
                return response()->json($products, 200);
            else
                return response()->json('false', 422);
        }
    }


        public function saveRuined(Request $request)
        {


            $ruinedHeader=new RuinedHeader();
            $ruinedHeader->ruinedable_id=$request->ruined_from;
            $ruinedHeader->ruinedable_type=($request->type=='restaurant')?'App\Restaurant':'App\Department';
            $ruinedHeader->restaurant_id = Auth::user()->restaurant->id;
            $ruinedHeader->save();

            foreach (json_decode($request->get('purses')) as $purse) {

                $product = $purse->product;
                $unit = $purse->unit;

                $ruinedProduct = new RuinedProduct();
                $ruinedProduct->product_id = $product->productId;
                $ruinedProduct->ruined_header_id	 = $ruinedHeader->id;
                $ruinedProduct->quantity = $purse->quantity;
                $ruinedProduct->price_unit = $purse->unit_cost;
                $ruinedProduct->note = $purse->note;
                $ruinedProduct->save();
            }

            return response()->json('Ok', 200);

        }

        public function deleteRefund($id)
        {
            RefundProduct::destroy($id);
            return redirect()->back();
        }
    public function getProductQuantity(Request $request,$id)
        {
            if($request->ruined_type=='restaurant'){
                $quantity=Product::find($id)->quantity;

            }else{
                $department=Department::find($request->ruined_from);
                $quantity=Product::find($id)->departmentquantity($department);

            }

                return response()->json($quantity, 200);

            }


    }
