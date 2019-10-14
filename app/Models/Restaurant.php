<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{

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


    public function getGrossPurchasesAttribute(){
        $total=0;
        $purchases=$this->purchases;
        foreach ($purchases as $purchase) {

            $total+=$purchase->pursesProducts->sum(function($t){
                return ($t->quantity * $t->unit_price)+($t->quantity * $t->unit_price)*($t->product->vat/100);
            });;
        }//->total;
        return $total;
    }
    public function getGrossPaymentsAttribute(){
        $total=   $this->paySupplier->sum('payment_amount');
        return $total;
    }

    public function getGrossRefundsAttribute(){

        $total=   $this->refunds->sum(function($t){
            return ($t->quantity * $t->unit_price)+($t->quantity * $t->unit_price)*($t->product->vat/100);
        });
        return $total;
    }
//

}
