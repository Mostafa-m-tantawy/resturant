<?php
namespace App;


use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Illuminate\Database\Eloquent\Model;

class PursesProduct extends Model
{    use baseTrait;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purse()
    {
        return $this->belongsTo(Purse::class);
    }
    public function getTotalAttribute()
    {
        return ($this ->quantity * $this->unit_price)+($this->quantity * $this->unit_price)*($this->vat/100);

    }
}
