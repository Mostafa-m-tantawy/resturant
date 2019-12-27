<?php

namespace App;

use App\Http\Traits\baseTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use baseTrait;

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function getOccupiedAttribute()
    {
        $order = $this->orders()->where('status', '<>', 'closed')->get();
        return ($order->count() > 0) ? true : false;
    }

    public function getCurrentOrderAttribute()
    {

        $order = $this->orders()->where('status', '<>', 'closed')->get();
        return ($order->count() > 0) ? $order->first()->id : 0;
    }
}
