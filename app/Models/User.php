<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,HasRoles,baseTrait,SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function phones(){
        return $this->hasMany(Phone::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }


    public function supplier(){
        return $this->hasOne(Supplier::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class)->with('user');
    }
    public function employee(){
        return $this->hasOne(HrEmployee::class);
    }
}
