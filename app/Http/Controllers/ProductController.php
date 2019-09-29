<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use App\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function products(Request $request, $supplier_id)
    {
        if ($request->product_g) {
            $supplier_id=Supplier::find($supplier_id)->user->id;
            foreach ($request->product_g as $newproduct) {
                $product = new Product();
                $product->name = $newproduct['name'];
                $product->barcode = $newproduct['barcode'];
                $product->reorder_point = $newproduct['reorder'];
                $product->product_type_id = 1;
                $product->unit_id = $newproduct['unit'];
                $product->supplier_id = $supplier_id;
                $product->vat = $newproduct['vat'];
                $product->save();

            }

        }

        $products = Product::where('supplier_id', $supplier_id)->get();
        $units=Unit::all();
        return view('frontend.supplier.products.products')
            ->with(compact('units','products', 'supplier_id'));
    }



    public function updateProduct(Request $request, $supplier_id)
    {            $supplier_id=Supplier::find($supplier_id)->user->id;

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->reorder_point = $request->reorder;
        $product->product_type_id = 1;
        $product->unit_id = $request->unit;
        $product->supplier_id = $supplier_id;
        $product->vat =$request->vat;
            $product->save();
        return redirect('product/create/' . $supplier_id);
    }



    public function deleteProduct($id)
    {
        $product = Product::find($id);
        Product::destroy($id);
        return redirect('product/create/' . $product->supplier->id);
    }
}
