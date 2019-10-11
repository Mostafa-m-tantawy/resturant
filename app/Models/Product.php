<?php
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $appends = ['quantity','quantity_available'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function purchasedProduct()
    {
        return $this->hasMany(PursesProduct::class);
    }
    public function assignDetails()
    {
        return $this->hasMany(AssignStockDetails::class);
    }
    public function refund()
    {
        return $this->hasMany(RefundProduct::class);
    }
 public function ruined()
    {
        return $this->hasMany(RuinedProduct::class);
    }

    //check out if quantity more than 0
    // return boolian
    public function getQuantityAvailableAttribute()
    {
     if($this->quantity>0)
        return true;
    else
        return false;
    }

    //return quantity
    public function getQuantityAttribute()
    {
   $purchases=$this->purchasedProduct()->whereHas('purse',function ($q){
       $q->where('restaurant_id',Auth ::user()->restaurant->id);
   });
        $assign_to_other=$this->assignDetails()->whereHas('assignHeader',function ($q){
            $q->where('restaurant_id',Auth ::user()->restaurant->id);
        });;
        $assign_to_me=$this->assignDetails()->whereHas('assignHeader',function ($q){
            $q->where('assignable_id',Auth ::user()->restaurant->id)->where('assignable_type','App\Restaurant');
        });;;
        $refund=$this->refund()->where('restaurant_id',Auth ::user()->restaurant->id);

        $ruind=$this->ruined()->whereHas('ruinedHeader',function ($q){
            $q->where('ruinedable_id',Auth ::user()->restaurant->id)->where('ruinedable_type','App\Restaurant');
        });;;


        $purchased_quantity= $purchases->sum('quantity');
        $assign_to_otherquantity= $assign_to_other->sum('quantity');
        $assign_to_me_quantity= $assign_to_me->sum('quantity');
        $refund_quantity=$refund->sum('quantity');
        $ruind_quantity=$ruind->sum('quantity');
//        if($this->id==6)
//            dd($refund_quantity);
        $totalquantity=$purchased_quantity-$ruind_quantity-$assign_to_otherquantity+$assign_to_me_quantity-$refund_quantity;
        return $totalquantity;
    }
    //
    //
    // quantity assign_to_me

    public function AssignQuantity($assignable)
    {
    $assign_to_me=$this->assignDetails()->whereHas('assignHeader',function ($q)use($assignable){
            $q->where('assignable_id',$assignable->id)->where('assignable_type',get_class($assignable));
        });
        return $assign_to_me->sum('quantity');;
    }




    /// price with 2 method last_price && avg_price
    /// between dates if method avrege price
 public function price($method,$from,$to)
    {

        $purchases=$this->purchasedProduct()->whereHas('purse',function ($q){
       $q->where('restaurant_id',Auth ::user()->restaurant->id);
   });
   if($method=='last_price' && $purchases->count()>0){
       return $purchases->orderByDesc('created_at')->first()->unit_price;

   }elseif($method=='avg_price' && $purchases->whereBetween('created_at',[$from,$to])->count()>0){

       return $purchases->whereBetween('created_at',[$from .' 00:00:00',$to.' 23:59:59'])->sum('unit_price')
           /$purchases->whereBetween('created_at',[$from .' 00:00:00',$to.' 23:59:59'])->count();

   }
    }








}
