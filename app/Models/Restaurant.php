<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

    //
    public function user (){
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purse::class,'restaurant_id');
    }

    public function paySupplier()
    {
        return $this->hasMany(Payment::class,'sender_id');
    }
    public function branches()
    {
        return $this->hasMany(Restaurant::class,'parent_id','user_id');
    }
    public function departments()
    {
        return $this->hasMany(Department::class);
    }


//

}
