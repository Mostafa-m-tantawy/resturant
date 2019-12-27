<?php
namespace App;

//namespace App\Model;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{    use baseTrait,restaurantScopeTrait;}

