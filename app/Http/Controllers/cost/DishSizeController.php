<?php

namespace App\Http\Controllers;

use App\Dish;
use App\DishCategory;
use App\DishSize;
use Illuminate\Http\Request;

class DishSizeController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:index dish size'],['only'=>['index']]);
        $this->middleware(['permission:create dish size'],['only'=>['store']]);
        $this->middleware(['permission:update dish size'],['only'=>['update']]);
//        $this->middleware(['permission:delete dish size'],['only'=>['delete']]);
    }



    public function index($id)
    {
        $dish = Dish::findOrFail($id);
        return view('frontend.dish.size.add-size')->with(compact('dish'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);


        $size = new DishSize;
        $size->name = $request->name;
        $size->price = $request->price;
        $size->dish_id = $request->dish_id;
        if ($request->status == 'on')
            $size->status = 1;
        else
            $size->status = 0;
        $size->save();
        return redirect(route('dish.size.index', [$request->dish_id]));
    }


    public function update(Request $request)
    {
        $size = DishSize::findOrFail($request->id);

        $validatedData = $request->validate([
            'name' => ['required', 'unique:dish_sizes,name,'.$size->id

                , 'max:255'],
            'price' => ['required', 'numeric'],
        ]);


        $size->name = $request->name;
        $size->price = $request->price;
        $size->dish_id = $request->dish_id;
        if ($request->status == 'on')
            $size->status = 1;
        else
            $size->status = 0;
        $size->save();
        return redirect(route('dish.size.index', [$request->dish_id]));
    }



}
