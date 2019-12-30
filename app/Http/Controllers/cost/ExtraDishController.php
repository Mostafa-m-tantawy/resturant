<?php

namespace App\Http\Controllers;

use App\DishCategory;
use App\DishSize;
use App\DishSizeExtra;
use Illuminate\Http\Request;

class ExtraDishController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:index extra dish'],['only'=>['index']]);
        $this->middleware(['permission:create extra dish'],['only'=>['store']]);
//        $this->middleware(['permission:update extra dish'],['only'=>['edit','update']]);
        $this->middleware(['permission:delete extra dish'],['only'=>['delete']]);
    }


    public  function  index($size_id){

        $dish_size = DishSize::findOrFail($size_id);

        $categories=DishCategory::with(['dishes'=>function($q){
            $q->where('type','extra');
        }])->whereHas('dishes',function($q){
            $q->where('type','extra');
        })->get();


        return view('frontend.dish.extra.add-extra')->with(compact('categories','dish_size'));

    }
    public  function  store(Request $request){
        $validatedData = $request->validate([
            'dish' => ['required'],
        ]);
        $extra=  DishSizeExtra::where('dish_size_id',$request->dish_size_id)->where('extra_id',$request->dish)->first();
        if(!$extra){
            $extra=new DishSizeExtra;
            $extra->dish_size_id=$request->dish_size_id;
            $extra->extra_id=$request->dish;
            $extra->save();
        }

        return redirect(route('dish.extra.index', [$request->dish_size_id]));

    }

    public function delete($id)
    {
        $size=DishSizeExtra::find($id)->dishSize;
        DishSizeExtra::destroy($id);
        return redirect(route('dish.extra.index', [$size->id]));

    }
}
