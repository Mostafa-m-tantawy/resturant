<?php
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purse extends Model
{

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function pursesProducts()
    {
        return $this->hasMany(PursesProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }

    public function pursesPayments()
    {
        return $this->hasMany(PursesPayment::class);
    }

    public function gettotalAttribute()
    {
        return $this->pursesProducts->sum(function($t){
            return ($t->quantity * $t->unit_price)+($t->quantity * $t->unit_price)*($t->product->vat/100);
        });


    }
    public function getvatAttribute()
    {
        return $this->pursesProducts->sum(function($t){
            return ($t->quantity * $t->unit_price)*($t->product->vat/100);
        });


    }
}
