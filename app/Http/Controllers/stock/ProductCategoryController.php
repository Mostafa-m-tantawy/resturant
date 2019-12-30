<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{

    public function __construct()
{
    $this->middleware(['permission:index product category'],['only'=>['index']]);
    $this->middleware(['permission:create product category'],['only'=>['create','store']]);
    $this->middleware(['permission:update product category'],['only'=>['update','edit']]);
    $this->middleware(['permission:delete product category'],['only'=>['destroy']]);
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=ProductCategory::all();
        return  view('frontend.product_category.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => ['required', 'string', 'max:255','unique:product_categories'],
            'description' => ['nullable', 'string', 'max:255'],

        ]);

        $category=new ProductCategory;
        $category->restaurant_id = Auth::user()->restaurant->id;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();

        return  redirect()->back();
    }

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

        $category= ProductCategory::findOrFail($request->id);
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:product_categories,name,'.$request->id],
            'description' => ['nullable', 'string', 'max:255'],

        ]);

        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();

        return  redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        if ($category->canDeleted) {
            $category->delete();
            return redirect()->back();
        } else {
            $error = 'category has products!';
            return redirect()->back()->withErrors($error);
        }

    }
}
