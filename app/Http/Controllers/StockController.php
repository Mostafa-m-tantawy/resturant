<?php

namespace App\Http\Controllers;

use App\CookedProduct;
use App\DishPrice;
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
        $from  =null;
        $to    =null;
        $method=null;
        if( $request->isMethod('post')){
            $method=$request->price_math_method;

        if($request->price_math_method!='last_price'){

            // lenght 10 date = (01/01/2001) =10
            $from   =substr($request->rangeofdate,0,10);
            // start  13 date = (01/01/2001 */*)=13
            $to     =substr($request->rangeofdate,13,10);
        }

        $restaurant_id=Auth::user()->restaurant->id;

        $products=Product::whereHas('purchasedProduct',function ($q)use($restaurant_id){

            $q->whereHas('purse',function ($qq)use($restaurant_id){

                $qq->where('restaurant_id',$restaurant_id);
            });
        })->get();
            return view('frontend.stock.index')->with(compact('products','from','to','method'));

        }
        return view('frontend.stock.index')->with(compact('from','to','method'));;





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
            return redirect()->to('/cannot-delete-item/' . $id);
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

    public function storeBatchstock(Request $request)
    {

//        $validation = $request->validate([
//            'excel' => 'required|mimes:xls,xlt,xla,xlsx,xltx,xlsm,xltm,xlam,xlsb',
//            'images' => 'required|mimes:zip'
//        ]);

        $tenancy = app(Environment::class);

        if ($request->hasFile('excel')) {

            $excel = $request->file('excel');
            $filename = date("dmY-his") . $excel->getClientOriginalName();
            $fulllink = 'media/imports/library';
            Storage::disk('tenant')->put($fulllink . '/' . $filename, file_get_contents($excel), 'public');

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $filename_images = date("dmY-his") . $images->getClientOriginalName();
                $fulllink_images = 'media/images/library';
                Storage::disk('tenant')->put($fulllink_images . '/' . $filename_images, file_get_contents($images), 'public');
            }

//extract from zip file images
            $zip = new ZipArchive();
            if ($zip->open(storage_path('app/tenancy/tenants/' . $tenancy->hostname()->website->uuid . '/' . $fulllink_images . '/' . $filename_images)) === TRUE) {
                $zip->extractTo(storage_path('app/tenancy/tenants/' . $tenancy->hostname()->website->uuid . '/' . $fulllink_images));
                $zip->close();
            }
//retrive 2 sheets of one file
            Excel::load(storage_path('app/tenancy/tenants/' . $tenancy->hostname()->website->uuid . '/' . $fulllink . '/' . $filename), function ($reader) {

                for ($i = 0; $i < count($reader->all()); $i++) {
                    if ($reader->all()[$i]->getTitle() == 'units') {
                        foreach ($reader->all()[$i] as $item) {
                            if ($item->unit_name) {
                                $unit = Unit::where( function ( $q2 ) use ( $item ) {
                                    $q2->whereRaw( 'LOWER(`unit`) like ?', array( $item->unit_name ) );
                                })->first();
                                if (!$unit) {
                                    $unit = new Unit();
                                    $unit->unit = $item->unit_name;
                                    $unit->child_unit = $item->child_unit;
                                    $unit->convert_rate = $item->convert;
                                    $unit->status = 1;
                                    $unit->user_id = auth()->user()->id;
                                    $unit->save();
                                }
                            }
                        }
                    } else if ($reader->all()[$i]->getTitle() == 'items') {

                        $j = 1;
                        foreach ($reader->all()[$i] as $item) {

                            $product_type = ProductType::where('product_type', $item->product_name)->first();
                            $unit = Unit::where( function ( $q2 ) use ( $item ) {
                                    $q2->whereRaw( 'LOWER(`unit`) like ?', strtolower( $item->unit_name ) );
                                })->first();
//                            where('unit', $item->unit_name)->first();

                            if ($unit) {

                                if (!$product_type) {
                                    $product_type = new ProductType();
                                    $product_type->product_type = $item->product_name;
                                    $product_type->user_id = auth()->user()->id;
                                    $product_type->status = 1;
                                    $product_type->save();
                                }
                                $itemm = new Product();

                                $itemm->product_name = $item->name;
                                $itemm->unit_id = $unit->id;
                                $itemm->product_type_id = $product_type->id;

                                if($item->image)
                                    $itemm->thumbnail = 'media/images/library/'.$item->image;
                                else
                                    $itemm->thumbnail = 'img/no image.jpeg';

                                $itemm->threshold =$item->threshold;
                                $itemm->user_id = auth()->user()->id;
                                $itemm->save();


                            } else {

                                $this->notFound_units[] = ['index' => $j, 'unit' => $item->unit_name];

                            }
                            $j++;
                        }
                    }
                }


            });


        }

        if (count($this->notFound_units) > 0) {
            $notFound_units = $this->notFound_units;
            return view('user.admin.stock.batch-stock')->with(compact('notFound_units'));
        } else {

            return redirect('all-item');
        }
    }

    public function downloadstocksample()
    {
        $pathToFile = public_path('sample/Batch stock Sample.xlsx');
        return response()->download($pathToFile);

    }
}
