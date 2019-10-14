<?php
namespace App;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    public function purchases()
    {
        return $this->hasMany(Purse::class)->where('restaurant_id',Auth::user()->restaurant->id);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class,'receiver_id')->where('sender_id',Auth::user()->restaurant->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('name');
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
        $total=   $this->payment->sum('payment_amount');
    return $total;
    }
    public function getGrossRefundsAttribute(){

        $total=   $this->refunds->where('restaurant_id',Auth::user()->restaurant->id)->sum(function($t){
            return ($t->quantity * $t->unit_price)+($t->quantity * $t->unit_price)*($t->product->vat/100);
        });
    return $total;
    }
}

