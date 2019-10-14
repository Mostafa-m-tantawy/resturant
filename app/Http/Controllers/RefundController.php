<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purse;
use App\PursesProduct;
use App\RefundProduct;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    public function index()
    {
        $refunds=RefundProduct::where('restaurant_id',Auth::user()->restaurant->id)->get();

        return view('frontend.refund.index',[
            'refunds'         =>      $refunds
        ]);
    }

  public function newRefund()
    {
       $suppliers = Supplier::all();
        return view('frontend.refund.new_refund',[
            'suppliers'         =>      $suppliers
        ]);
    }




    public function saveRefund(Request $request)
    {

             foreach (json_decode($request->get('purses')) as $purse) {

                $product = $purse->product;
                $unit = $purse->unit;

                $refundProduct = new RefundProduct();
                $refundProduct->product_id = $product->productId;
                $refundProduct->supplier_id	 =  $request->get('supplier_id');
                $refundProduct->restaurant_id	 = Auth::user()->restaurant->id;
                $refundProduct->quantity = $purse->quantity;
                $refundProduct->unit_price = $unit->unitPrice;
                $refundProduct->note = $purse->note;
                 $refundProduct->save();
            }

            return response()->json('Ok',200);

    }

    public function deleteRefund($id)
    {
RefundProduct::destroy($id);
return redirect()->back();
    }


}
