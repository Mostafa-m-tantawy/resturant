<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class DishSize extends Model
{
    use baseTrait;

    public function dish(){
        return $this->belongsTo(Dish::class);
    }
    public function recipes(){
        return $this->hasMany(DishSizeRecipe::class);
    }
    public function sides(){
        return $this->hasMany(DishSizeSide::class);
    }
    public function extras(){
        return $this->hasMany(DishSizeExtra::class);
    }

    protected $appends = ['quantity','cost'];

    public function getQuantityAttribute()
    {
        $recipes=$this->recipes;
        $quantities=[];
        foreach ($recipes as $recipe){
        $quantities[]=$recipe->product->departmentquantity($this->dish->department)/$recipe->unit_quantity;
        }
        if(count($quantities)>0){
            return min($quantities);

        }else{
            return 0;

        }

    }
    public function getCostAttribute()
    {
        $recipes=$this->recipes;
        $total=0;
        foreach ($recipes as $recipe){
            $total=$recipe->product->cost *$recipe->unit_quantity;
        }

            return $total;



    }
}
