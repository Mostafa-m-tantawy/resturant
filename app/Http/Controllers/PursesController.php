<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Product;
use App\Purse;
use App\PursesProduct;
use App\Restaurant;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PursesController extends Controller
{

    /**
     * Show new purses form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPurchase()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::all();
        $units = Unit::all();
        return view('frontend.purchase.new-purses',[
            'products'          =>      $products,
            'units'             =>      $units,
            'suppliers'         =>      $suppliers
        ]);
    }


    /**
     * All purses
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function SummeryIndex()
    {
        $purses = Purse::where('restaurant_id',Auth::user()->restaurant->id)->get();

        return view('frontend.purchase.summery_index',[
            'purses'            =>      $purses
        ]);
    }
    public function detailedIndex()
    {

        $purses = Purse::all();

        return view('frontend.purchase.detailed_index',[
            'purses'            =>      $purses
        ]);
    }

    /**
     * Eidt purses
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPurses($id)
    {
        $purses = Purse::findOrFail($id);
        $products=$purses->supplier->products;

        $suppliers = Supplier::all();
        $unit = Unit::all();
        return view('frontend.purchase.edit-purses',[
            'products'          =>      $products,
            'units'             =>      $unit,
            'suppliers'         =>      $suppliers,
            'purses'            =>      $purses
        ]);
    }


    /**
     * New purses store into database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function savePurses(Request $request)
    {
        $user=  auth()->user();
        $purses = new Purse();
        $purses->supplier_id = $request->get('supplier_id');
        $purses->user_id = $user->id;
        $purses->restaurant_id = $user->restaurant->id;
        if($purses->save()) {

            if($request->hasfile('files')) {
                $purses->upload($request->file('files'));
            }
            foreach (json_decode($request->get('purses')) as $purse) {

                $product = $purse->product;
                $unit = $purse->unit;
                $pursesProduct = new PursesProduct();
                $pursesProduct->purse_id = $purses->id;
                $pursesProduct->product_id = $product->productId;
                $pursesProduct->quantity = $purse->quantity;
                $pursesProduct->unit_price = $unit->unitPrice;
                $pursesProduct->Vat = $product->vat;

                if ($pursesProduct->save()) {



                } else {
                    PursesProduct::where('purses_id', $purses->id)->delete();
                    Purse::destroy($purse->id);
                    return response()->json('Internal Serer Error', 500);
                }
            }

            if($request->get('payment')=='cash'){
                $payment=new Payment;
                $payment->restaurant_id= $user->restaurant->id;;
                $payment->payment_amount=$purses->total;
                $payment->payment_method='cash';
                $payment->sender_id=$user->restaurant->id;;;
                $payment->receiver_id=$request->get('supplier_id');;
                $payment->save();
            }
//            $vat= Systemconf::where('name','RESTAURANT_VAT_PERCENTAGE')->first()->value;
//            $purses->vat= $purses->pursesProducts->sum('gross_price')*($vat/100);
//            $purses->save();

            return response()->json('Ok',200);
        }else{
            return response()->json('Internal Server Error',422);
        }
    }


    /**
     *
     * @param Request $request
     * @param $id
     * @return array
     */
        /**
     * Get products unit by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnitOfProduct($id)
    {
        $product = Product::where('id',$id)->with('unit')->first();
        return response()->json($product);
    }

    /**
     * View purses details page
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPursesDetails($id)
    {
        $purses = Purse::with('pursesProducts')->with('pursesPayments')->findOrFail($id);
        return response()->json($purses);
    }


    /**
     * Delete purses product
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePursesProduct($id)
    {
        PursesProduct::destroy($id);
        return redirect()->back();
    }

    /**
     * Save purses product
     * @param Request $request
     * @param $purses_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePursesProduct(Request $request,$id)
    {
        $pursesProduct = new PursesProduct();
        $pursesProduct->purse_id = $id;
        $pursesProduct->product_id = $request->get('product_id');
        $pursesProduct->quantity = $request->get('quantity');
        $pursesProduct->unit_price = $request->get('unit_price');
        $pursesProduct->vat = $request->get('vat');
        if($pursesProduct->save()){
            return redirect()->back();
        }
    }

    /**
     * Delete purses
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */


    public function supplierProducts($id)
    {
        $products=Supplier::find($id)->products;
        return response()->json($products,200);

    }



}
