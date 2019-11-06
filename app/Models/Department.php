<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function RuinedHeader(){
        return $this->morphTo(RuinedHeader::class,'ruinedable');
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
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
