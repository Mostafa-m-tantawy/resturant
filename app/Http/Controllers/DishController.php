<?php

namespace App\Http\Controllers;

use App\Department;
use App\Dish;
use App\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DishController extends Controller
{


    public function index(){
        $categories=DishCategory::all();
        return view('frontend.dish.dish.index')->with(compact('categories'));
    }




    public function create()
    {
        $categories = DishCategory::all();
        $departments = Department::all();
        return view('frontend.dish.dish.create')->with(compact('categories','departments'));
    }




    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:dishes', 'max:255'],
            'description' => ['nullable','max:255'],
            'image' => ['nullable','image'],
            'category' => ['required'],
            'type' => ['required', Rule::in(['dish', 'side', 'extra'])
            ],
        ]);
        $dish=new Dish;
        $dish->restaurant_id = Auth::user()->restaurant->id;
        $dish->name=$request->name;
        $dish->description=$request->description;
        $dish->dish_category_id=$request->category;
        $dish->department_id=$request->department ;
        $dish->type=$request->type;
        if($request->status=='on')
            $dish->status=1;
        else
            $dish->status=0;

        $dish->save();
        return redirect(route('dish.size.index',[$dish->id]));
    }







    public function edit($id)
    {
        $dish=Dish::findOrFail($id);
        $categories = DishCategory::all();
        $departments = Department::all();

        return view('frontend.dish.dish.edit')->with(compact('dish','categories','departments'));
    }



    public function update(Request $request,$id)
    {
        $dish=Dish::findOrFail($id);

        $validatedData = $request->validate([
            'name' => ['required', 'unique:dishes,name,'.$dish->id, 'max:255'],
            'description' => ['nullable','max:255'],
            'image' => ['nullable','image'],
            'category' => ['required'],
            'type' => ['required', Rule::in(['dish', 'side', 'extra'])
            ],
        ]);
        $dish->name=$request->name;
        $dish->description=$request->description;
        $dish->dish_category_id=$request->category;
        $dish->department_id=$request->department;

        $dish->type=$request->type;
        if($request->status=='on')
            $dish->status=1;
        $dish->save();
        return redirect(route('dish.size.index',[$dish->id]));
    }


public function getDishes($id){

        $dishes=Dish::where('type',$id)->where('status',1)->with('sizes')->get();
        if($dishes->count()>0)
        return response()->json($dishes,200);
        else
        return response()->json(['error'=>trans('main.there is dishes in this category')],422);
}

}


