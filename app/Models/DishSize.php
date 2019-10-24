<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishSize extends Model
{

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

    protected $appends = ['quantity'];

    public function getQuantityAttribute()
    {
        $recipes=$this->recipes;
        $quantities=[];
        foreach ($recipes as $recipe){
        $quantities[]=$recipe->product->departmentquantity('department',$this->dish->department_id)/$recipe->unit_quantity;
        }
        if(count($quantities)>0){
            return min($quantities);

        }else{
            return 0;

        }

    }
}
