<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class PursesProduct extends Model
{
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
        return ($this ->quantity * $this->unit_price)+($this->quantity * $this->unit_price)*($this->product->vat/100);

    }
}
