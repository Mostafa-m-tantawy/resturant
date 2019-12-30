<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use baseTrait,restaurantScopeTrait;

    public  function  sizes(){
        return $this->hasMany(DishSize::class);
    }
   public  function  department(){
        return $this->belongsTo(Department::class);
    }
  public  function  category(){
        return $this->belongsTo(DishCategory::class,'dish_category_id');
    }
//    protected $appends = ['stock_available'];

    public  function  getStockAvailableAttribute(){
        $available=false;
        foreach ($this->sizes as $size){
        if($size->quantity>0){
            $available=  true;
            break;
        }
         }
    return ($available)?'available':'not Available';
    }

}
