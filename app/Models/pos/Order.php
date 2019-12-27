<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use baseTrait, restaurantScopeTrait;

    protected $appends = ['cash'];

    public function orderDetails()
    {

        return $this->hasMany(OrderDetails::class)->where('parent_id', null);
    }
    public function adds()
    {

        return $this->hasMany(OrderDetails::class)->where('parent_id', '<>',null);
    }

    public function tables()
    {

        return $this->belongsToMany(Table::class);
    }

    public function getVatAttribute()
    {

        return ($this->getOriginal('vat')) * ($this->sup_total + $this->service);

    }


    public function getServiceAttribute()
    {

        return ($this->getOriginal('service')) * $this->sup_total;

    }


    public function getCouponValueAttribute()
    {


        if ($this->getOriginal('coupon'))
            return ($this->supTotal * $this->getOriginal('coupon'));
        else
            return 0;
    }

    public function getSupTotalAttribute()
    {


        if ($this->is_staff) {
            $details = $this->orderDetails->sum(function ($t) {
                return $t->unit_cost * $t->quantity;
            });

            $adds=$this->adds->where('unit_price','<>',0)->sum(function ($t) {
                return $t->unit_cost * $t->quantity;
            });
        } else {
            $details = $this->orderDetails->sum(function ($t) {
                return $t->unit_price * $t->quantity;
            });

            $adds=$this->adds->sum(function ($t) {
                return $t->unit_price * $t->quantity;
            });
        }
        return $details+$adds ;
    }

    public function getSupTotalCostAttribute()
    {

        $details = $this->orderDetails->sum(function ($t) {
            return $t->unit_cost * $t->quantity;
        });

        return $details;

    }

    public function getGrossTotalAttribute()
    {

        return $this->sup_total + $this->vat + $this->service + $this->delivery -$this->discount-$this->CouponValue;

    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id');
    }

    public function getCashAttribute()
    {
        return $this->hasMany(OrderPayment::class, 'order_id')
            ->where('method', 'cash')->sum('amount');
    }

    public function getAccountAttribute()
    {
        return $this->hasMany(OrderPayment::class, 'order_id')
            ->where('method', 'account')->sum('amount');;
    }

    public function getCheckAttribute()
    {
        return $this->hasMany(OrderPayment::class, 'order_id')
            ->where('method', 'check')->sum('amount');;
    }


    public function getCreditCardAttribute()
    {
        return $this->hasMany(OrderPayment::class, 'order_id')
            ->where('method', 'creditcard')->sum('amount');;
    }



    public function getDemandAttribute()
    {
        return $this->GrossTotal - $this->payment;

    }

   public function getPaidAttribute()
    {
        return ($this->demand >0)?'unpaid':'paid';
    }

    public function getPaymentAttribute()
    {
        $total = 0;
        $total = $this->payments->sum('amount');

        return $total;
    }

}
