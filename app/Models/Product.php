<?php

namespace App;

use App\Scopes\restaurantScope;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }
    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'product_supplier')->withPivot('vat');
    }

    protected $appends = ['quantity', 'quantity_available'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
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

    public function vat($supplier)
    {
//        dd($supplier);
        $vat = $supplier->products->where('id', $this->id)->first()->pivot->vat;
        return $vat != null ? $vat : 0;
    }

    //check out if quantity more than 0
    // return boolian
    public function getQuantityAvailableAttribute()
    {
        if ($this->quantity > 0)
            return true;
        else
            return false;
    }

    //return quantity
    public function getQuantityAttribute()
    {
        return $this->quantityAvailable(Auth::user()->restaurant);
    }

    // quantity assign_to_me

    public function AssignQuantity($assignable)
    {
        $assign_to_me = $this->assignDetails()->whereHas('assignHeader', function ($q) use ($assignable) {
            $q->where('assignable_id', $assignable->id)->where('assignable_type', get_class($assignable));
        });
        return $assign_to_me->sum('quantity');;
    }


    public function quantityAvailable($model)
    {

        $purchases = $this->purchasedProduct()->whereHas('purse', function ($q) use ($model) {
            $q->where('restaurant_id', $model->id);
        });
        $assign_to_other = $this->assignDetails()->whereHas('assignHeader', function ($q) use ($model) {
            $q->where('restaurant_id', $model->id);
        });;
        $assign_to_me = $this->assignDetails()->whereHas('assignHeader', function ($q) use ($model) {
            $q->where('assignable_id', $model->id)->where('assignable_type', get_class($model));
        });;;
        $refund = $this->refund()->where('restaurant_id', $model->id);

        $ruind = $this->ruined()->whereHas('ruinedHeader', function ($q) use ($model) {
            $q->where('ruinedable_id', $model->id)->where('ruinedable_type', get_class($model));
        });;;


        $purchased_quantity = $purchases->sum('quantity');
        $assign_to_otherquantity = $assign_to_other->sum('quantity');
        $assign_to_me_quantity = $assign_to_me->sum('quantity');
        $refund_quantity = $refund->sum('quantity');
        $ruind_quantity = $ruind->sum('quantity');
        //        if($this->id==6)
        //            dd($refund_quantity);
        $totalquantity = $purchased_quantity - $ruind_quantity - $assign_to_otherquantity + $assign_to_me_quantity - $refund_quantity;
        return $totalquantity;
    }

    /// price with 2 method last_price && avg_price
    /// between dates if method avrege price
    public function getCostAttribute()
    {
        $sysyemConf=SystemConf::all();
        $method=$sysyemConf->where('name','method')->first()->value;
           if($method == 'avg_price' ) {
               $from =  Carbon::now()->toDateString();
               $to = Carbon::now()->subMonth($sysyemConf->where('name','months')->first()->value) ->toDateString();
           }

        $purchases = $this->purchasedProduct()->whereHas('purse', function ($q) {
            $q->where('restaurant_id', Auth::user()->restaurant->id);
        });
        if ($method == 'last_price' && $purchases->count() > 0) {
            return $purchases->orderByDesc('created_at')->first()->unit_price;

        } elseif ($method == 'avg_price' && $purchases->whereBetween('created_at', [$from, $to])->count() > 0) {

            return $purchases->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                    ->get()->sum(function ($t) {
                        return $t->unit_price * $t->quantity;
                    })
                /
                $purchases->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                    ->get()->sum('quantity');

        }
    }


    public function departmentquantity($type, $from)
    {


        if ($type == 'restaurant') {
            return $this->quantity;
        } elseif ($type == 'department') {
            $department = Department::find($from);
            $assign_to_me = $this->assignDetails()->whereHas('assignHeader', function ($q) use ($department) {
                $q->where('assignable_id', $department->id)->where('assignable_type', get_class($department));
            });;;

            $ruind = $this->ruined()->whereHas('ruinedHeader', function ($q) use ($department) {
                $q->where('ruinedable_id', $department->id)->where('ruinedable_type', get_class($department));
            });;;
            $assign_to_me_quantity = $assign_to_me->sum('quantity');
            $ruind_quantity = $ruind->sum('quantity');

            $totalquantity = -$ruind_quantity + $assign_to_me_quantity;
            return $totalquantity;
        }
    }


}
