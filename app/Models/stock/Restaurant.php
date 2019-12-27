<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{    use baseTrait;


    //
    public function user (){
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purse::class,'restaurant_id');
    }

    public function paySupplier()
    {
        return $this->hasMany(Payment::class,'sender_id');
    }
    public function branches()
    {
        return $this->hasMany(Restaurant::class,'parent_id','user_id');
    }
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
   public function refunds()
    {
        return $this->hasMany(RefundProduct::class);
    }

  public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }


    public function getGrossPurchasesAttribute(){
        $total=0;
        $purchases=$this->purchases;
        foreach ($purchases as $purchase) {

            $total+=$purchase->pursesProducts->sum(function($t){
                return ($t->quantity * $t->unit_price)+($t->quantity * $t->unit_price)*($t->vat/100);
            });;
        }//->total;
        return $total;
    }
    public function getNameAttribute(){

        return $this->user->name;
    }
    public function getGrossPaymentsAttribute(){
        $total=   $this->paySupplier->sum('payment_amount');
        return $total;
    }

    public function getGrossRefundsAttribute(){

        $total=   $this->refunds->sum(function($t){
            return ($t->quantity * $t->unit_price)+($t->quantity * $t->unit_price)*($t->vat/100);
        });
        return $total;
    }
    public function getProductsAttribute(){

        $products=Product::
        whereHas('purchasedProduct',function ($q){
            $q->whereHas('purse',function ($qq){
                $qq->where('restaurant_id',$this->id);
            });
        })-> OrWhereHas('assignDetails',function ($q){
            $q->whereHas('assignHeader',function ($qq){
                $qq->where('assignable_id',$this->id)->where('assignable_type','App\Restaurant');
            });


        })->get()->where('quantity_available',true);

        return $products;
    }
//

}
