<?php
namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Http\Traits\uploadFileTrait;
use App\Scopes\restaurantScope;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purse extends Model
{    use uploadFileTrait, baseTrait,restaurantScopeTrait;

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



    public function getTotalAttribute()
    {

        return $this->pursesProducts->sum(function($t){
            return ($t->quantity * $t->unit_price)+($t->quantity * $t->unit_price)*($t->vat/100);

        });

    }
    public function getVatAttribute()
    {

        return $this->pursesProducts->sum(function($t){
            return ($t->quantity * $t->unit_price)*($t->vat/100);
        });

    }
}
