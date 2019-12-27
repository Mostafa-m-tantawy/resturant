<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use Spatie\Permission\Models\Role as SptRole;

class Role extends SptRole
{ use baseTrait,restaurantScopeTrait;

    //
}
