<?php

namespace App\Http\Controllers;

use App\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishCategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:index dish category'],['only'=>['index']]);
        $this->middleware(['permission:create dish category'],['only'=>['create','store']]);
        $this->middleware(['permission:update dish category'],['only'=>['edit','update']]);
//        $this->middleware(['permission:delete dish category'],['only'=>['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=DishCategory::all();;
        return  view('frontend.dish_category.index')->with(compact('categories'));;

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
            'name' => ['required', 'string', 'max:255','unique:dish_categories'],
            'description' => ['nullable', 'string', 'max:255'],

        ]);

        $category=new DishCategory();
        $category->name=$request->name;
        $category->description=$request->description;
        $category->restaurant_id = Auth::user()->restaurant->id;
        if($request->show=='on')
            $category->show = 1;
        else
        $category->show = 0;
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

        $category=DishCategory::findOrFail($request->id);
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:dish_categories,name,'.$request->id],
            'description' => ['nullable', 'string', 'max:255'],

        ]);

        $category->name=$request->name;
        $category->description=$request->description;
        if($request->show=='on')
            $category->show = 1;
        else
            $category->show = 0;
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
        //
    }
}
