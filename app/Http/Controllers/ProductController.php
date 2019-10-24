<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    public  function index(){
        $categories=ProductCategory::all();
        $units=Unit::all();

        return view('frontend.products.index')->with(compact('categories','units'));
    }

    public  function create(){
        $categories=ProductCategory::all();
        $units=Unit::all();

        return view('frontend.products.create')->with(compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => ['required', 'string', 'max:255','unique:products'],
            'description'       => ['nullable', 'string', 'max:255'],
            'barcode'           => ['nullable', 'string', 'max:255'],
            'reorder_point'     => ['nullable', 'numeric'],
            'category'=> ['required'],
            'unit'           => ['required'],
        ]);
        $product = new Product();
        $product->restaurant_id = Auth::user()->restaurant->id;
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->reorder_point = $request->reorder_point;

       if( $request->is_stockable=='on'){

           $product->is_stockable = 1;
       }else{
           $product->is_stockable = 0;

       }
        $product->product_category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->save();

return  redirect('product')  ;      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'name'              => ['required', 'string', 'max:255','unique:products,name,'.$request->id],
            'description'       => ['nullable', 'string', 'max:255'],
            'barcode'           => ['nullable', 'string', 'max:255'],
            'reorder_point'     => ['nullable', 'numeric'],
            'category'=> ['required'],
            'unit'           => ['required'],
        ]);
        $product =  Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->reorder_point = $request->reorder_point;

        if( $request->is_stockable=='on'){

            $product->is_stockable = 1;
        }else{
            $product->is_stockable = 0;

        }
        $product->product_category_id = $request->category;
        $product->unit_id = $request->unit;
        $product->save();

        return  redirect('product')  ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }





    public function products(Request $request, $supplier_id)
    {
        $supplier=Supplier::findOrFail($supplier_id);

        if ($request->product_g) {
            foreach ($request->product_g as $newproduct) {

                $supplier->products()->syncWithoutDetaching([$newproduct['product']=>['vat' => $newproduct['vat']]]);
            }

        }
        $products = Product::all();
        $units=Unit::all();
        return view('frontend.supplier.products')
            ->with(compact('units','products', 'supplier'));
    }



    public function deleteProduct($id,$supplier_id)
    {
        $product = Product::find($id);
        $product->supplier()->detach($supplier_id);
        return redirect('product/create/' . $supplier_id);
    }
}
