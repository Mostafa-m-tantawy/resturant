<?php

namespace App;

use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class SystemConf extends Model
{
    protected $fillable=['name','value','restaurant_id'];


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new restaurantScope());
    }}
