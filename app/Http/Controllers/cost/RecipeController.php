<?php

namespace App\Http\Controllers;

use App\Dish;
use App\DishCategory;
use App\DishSize;
use App\DishSizeRecipe;
use App\Product;
use App\ProductCategory;
use App\Recipe;
use App\Supplier;
use Illuminate\Http\Request;

class RecipeController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:index dish recipe'],['only'=>['index']]);
        $this->middleware(['permission:create dish recipe'],['only'=>['store']]);
//        $this->middleware(['permission:update dish size'],['only'=>['edit','update']]);
        $this->middleware(['permission:delete dish recipe'],['only'=>['delete']]);
    }


    public function index($id)
    {
        $dish_size = DishSize::findOrFail($id);
        $categories   =ProductCategory::all();

        return view('frontend.dish.recipe.add-recipe')->with(compact('dish_size','categories'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product' => ['required'],
            'quantity' => ['required', 'numeric'],
        ]);
      $recipe=  DishSizeRecipe::where('product_id',$request->product)->where('dish_size_id',$request->dish_size_id)->first();
if(!$recipe){
    $recipe = new DishSizeRecipe();

}

        $recipe->product_id = $request->product;
        $recipe->unit_quantity = $request->quantity;
        $recipe->child_unit_quantity = $request->child;
        $recipe->dish_size_id = $request->dish_size_id;

        $recipe->save();
        return redirect(route('dish.recipe.index', [$request->dish_size_id]));
    }



    public function delete($id)
    {
        $size=DishSizeRecipe::find($id)->dishSize;
        DishSizeRecipe::destroy($id);
        return redirect(route('dish.recipe.index', [$size->id]));

    }
}
