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

}
