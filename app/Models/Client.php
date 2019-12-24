<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use baseTrait, restaurantScopeTrait;

    public function payments()
    {

        return $this->hasMany(ClientAccount::class, 'client_id');

    }

    public function orderPayments()
    {

        return $this->hasMany(OrderPayment::class, 'client_id');

    }

    public function getHisMoneyAttribute()
    {

        return $this->payments()->sum('amount')-$this->orderPayments()->sum('amount');

    }

}
