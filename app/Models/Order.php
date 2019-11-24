<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use baseTrait,restaurantScopeTrait;


    public function  orderDetails(){

        return $this->hasMany(OrderDetails::class);
    }

    public function getVatAttribute(){

        return ($this->getOriginal('vat')/100)*($this->sup_total+$this->service);

    }


    public function getServiceAttribute(){

        return ($this->getOriginal('service')/100)*$this->sup_total;

    }


    public function getSupTotalAttribute(){

        $details=$this->orderDetails->sum(function ($t){
            return $t->unit_price*$t->quantity;
        });
        return $details;

    }
public function getSupTotalCostAttribute(){

        $details=$this->orderDetails->sum(function ($t){
            return $t->unit_cost*$t->quantity;
        });
        return $details;

    }

    public function getGrossTotalAttribute(){

        return $this->sup_total+$this->vat+$this->service;

    }

}
