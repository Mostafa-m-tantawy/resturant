<?php

namespace App\Http\Controllers;

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

        $purses = Purse::where('restaurant_id',Auth::user()->restaurant->id)->get();

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
//        if ($request->hasFile('image')) {
//            $images = $request->file('image');
//            $filename_images = date("dmY-his") . $images->getClientOriginalName();
//            $fulllink_images = 'media/images/library';
//            Storage::disk('tenant')->put($fulllink_images . '/' . $filename_images, file_get_contents($images), 'public');
//            $purses->image = $fulllink_images . '/' . $filename_images;
//
//        }
        if($purses->save()) {
            foreach (json_decode($request->get('purses')) as $purse) {

                $product = $purse->product;
                $unit = $purse->unit;
                $pursesProduct = new PursesProduct();
                $pursesProduct->purse_id = $purses->id;
                $pursesProduct->product_id = $product->productId;
                $pursesProduct->quantity = $purse->quantity;
                $pursesProduct->unit_price = $unit->unitPrice;

                if ($pursesProduct->save()) {
//                    $producttocook=Product::find($product->productId);
//                    if($producttocook->iscookable){
//                        foreach ($producttocook->prepareRecipes as $recipe) {
//
//                            $cookedProduct = new CookedProduct();
//                            $cookedProduct->cookable_id = $product->productId;
//                            $cookedProduct->cookable_type = 'App\Product';
//                            $cookedProduct->product_id = $recipe->product_id;
//                            $cookedProduct->quantity = $recipe->unit_needed * $purse->quantity;
//                            $cookedProduct->save();
//                        }
//                    }
                } else {
                    PursesProduct::where('purses_id', $purses->id)->delete();
                    Purse::destroy($purse->id);
                    return response()->json('Internal Serer Error', 500);
                }
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
    public function updatePurses(Request $request,$id)
    {
        return $request->all();
    }

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
