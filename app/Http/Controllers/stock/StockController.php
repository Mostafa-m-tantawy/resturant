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
    /**
     * Current stock
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function assign()
    {
       $products=Product::whereHas('purchasedProduct',function ($q){
           $q->whereHas('purse',function ($qq){
              $qq->where('restaurant_id',Auth::user()->retaurant->id);
           });
       })->get();

        return view('user.admin.stock.all-item')->with(compact('products'));
    }

    /**
     * Add new stock
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addStock()
    {
        $unit = Unit::all();
        $product_type = ProductType::where('status', 1)->get();
        return view('user.admin.stock.add-item', [
            'units' => $unit,
            'product_type' => $product_type
        ]);
    }

    /**
     * Edit stock
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editStock($id)
    {
        $item = Product::findOrFail($id);
        $unit = Unit::all();
        $product_type = ProductType::where('status', 1)->get();
        return view('user.admin.stock.edit-item', [
            'item' => $item,
            'units' => $unit,
            'product_type' => $product_type
        ]);
    }

    /**
     * View stock details
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewStock($id)
    {
        $item = Product::findOrFail($id);
        return view('user.admin.stock.view-item', [
            'item' => $item
        ]);
    }

    /**
     * Delete stock if not use in dish recipe
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteStock($id)
    {
        $product = Product::findOrFail($id);
        $product_on_dish = Recipe::where('product_id', $id)->first();
        $product_on_purses = PursesProduct::where('product_id', $id)->first();
        $product_on_cooked = CookedProduct::where('product_id')->first();
        if (!$product_on_dish || !$product_on_purses || !$product_on_cooked) {
            return redirect()->to('stock/cannot-delete-item/' . $id);
        } else {
            $product->delete();
            return redirect()->back();
        }

    }

    /**
     * show cannot delete product if the product has been used in dish recipe
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cannotDeleteStock($id)
    {
        $product = Product::findOrFail($id);
        return view('user.admin.stock.cannot-delete', [
            'product' => $product
        ]);
    }

    /**
     * Add new product
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveStock(Request $request)
    {
        $request->validate([
            'product_name'       =>     'required|max:255', //|unique:products make issue cant understand its tenant db only get walemah mt and no tbl founf
            'unit_id'            =>     'required|max:11',
            'product_type_id'    =>     'required|max:11',
            'product_threshold'  =>     'required|numeric'

        ]);

        $item = new Product();
        $item->product_name = $request->get('product_name');
        $item->unit_id = $request->get('unit_id');
        $item->product_type_id = $request->get('product_type_id');

        $item->threshold = $request->get('product_threshold');
        if($request->hasFile('thumbnail')){
            $item->thumbnail = $request->file('thumbnail')
                ->move('uploads/products/thumbnail',
                    rand(8000000, 99999999) . '.' . $request->thumbnail->extension());
        }
        $item->user_id = auth()->user()->id;
        if ($item->save()) {
            return response()->json('Ok', 200);
        }
    }

    /**
     * Update product info
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStock(Request $request, $id)
    {
        $request->validate([
          //  'product_name'       =>     Rule::unique('products')->ignore($id, 'id'),
            'unit_id'            =>     'required|max:11',
            'product_type_id'    =>     'required|max:11',
            'product_threshold'  =>     'required|numeric'

        ]);

        $item = Product::findOrFail($id);
        $item->product_name = $request->get('product_name');
        $item->unit_id = $request->get('unit_id');
        $item->product_type_id = $request->get('product_type_id');
        $item->threshold = $request->get('product_threshold');
        if($request->hasFile('thumbnail')){

            $item->thumbnail = $request->file('thumbnail')
                ->move('uploads/products/thumbnail',
                    rand(8000000, 99999999) . '.' . $request->thumbnail->extension());
        }
        $item->user_id = auth()->user()->id;
        if ($item->save()) {
            return response()->json('Ok', 200);
        }
    }

    public function batchstock()
    {

        return view('user.admin.stock.batch-stock');
    }
// I defined  $notFound_units as protected field becouse of excel function
    protected $notFound_units = [];

    public function downloadstocksample()
    {
        $pathToFile = public_path('sample/Batch stock Sample.xlsx');
        return response()->download($pathToFile);

    }
}
