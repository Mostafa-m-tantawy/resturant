<?php
namespace App;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function purchases()
    {
        return $this->hasMany(Purse::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class,'receiver_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('name');
    }
}
