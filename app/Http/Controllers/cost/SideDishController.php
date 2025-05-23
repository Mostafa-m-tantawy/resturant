<?php

namespace App\Http\Controllers;

use App\DishCategory;
use App\DishSize;
use App\DishSizeSide;
use Illuminate\Http\Request;

class SideDishController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:index side dish'],['only'=>['index']]);
        $this->middleware(['permission:create side dish'],['only'=>['store']]);
//        $this->middleware(['permission:update dish size'],['only'=>['edit','update']]);
        $this->middleware(['permission:delete side dish'],['only'=>['delete']]);
    }


    public  function  index($size_id){

        $dish_size = DishSize::findOrFail($size_id);
        if($dish_size->dish->type != 'dish'){
            return redirect()->route('dish.index');
        }
        $categories=DishCategory::with(['dishes'=>function($q){
            $q->where('type','side');
        }])->whereHas('dishes',function($q){
            $q->where('type','side');
        })->get();
        return view('frontend.dish.side.add-side')->with(compact('categories','dish_size'));

    }
    public  function  store(Request $request){
        $validatedData = $request->validate([
            'dish' => ['required'],
        ]);
        $recipe=  DishSizeSide::where('dish_size_id',$request->dish_size_id)->where('side_id',$request->dish)->first();
        if(!$recipe){
            $side=new DishSizeSide;
            $side->dish_size_id=$request->dish_size_id;
            $side->side_id=$request->dish;
            $side->save();
        }

        return redirect(route('dish.side.index', [$request->dish_size_id]));

    }

    public function delete($id)
    {
        $size=DishSizeSide::find($id)->dishSize;
        DishSizeSide::destroy($id);
        return redirect(route('dish.side.index', [$size->id]));

    }

}
