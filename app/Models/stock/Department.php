<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use baseTrait,restaurantScopeTrait;

    public function RuinedHeader(){
        return $this->morphTo(RuinedHeader::class,'ruinedable');
    }



    public function getProductsAttribute(){

        $products=Product::
      WhereHas('assignDetails',function ($q){
            $q->whereHas('assignHeader',function ($qq){
                $qq->where('assignable_id',$this->id)->where('assignable_type','App\Department');
            });
        })->get()->where('quantity_available',true);

        return $products;
    }
}
