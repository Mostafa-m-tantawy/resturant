<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Spatie\Permission\Models\Permission as spPerm ;
class Permission extends spPerm
{   use baseTrait;
    //
}
