<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use App\PursesProduct;
use App\Recipe;
use App\Unit;
use App\User;
use Hyn\Tenancy\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:stock restaurant'],['only'=>['index']]);
    }

    /**
     * Current stock
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {


        $restaurant_id=Auth::user()->restaurant->id;

        $products=Product::whereHas('purchasedProduct',function ($q)use($restaurant_id){

            $q->whereHas('purse',function ($qq)use($restaurant_id){

                $qq->where('restaurant_id',$restaurant_id);
            });
        })->get();

            return view('frontend.stock.index')->with(compact('products'));
    }




}
