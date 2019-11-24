<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;

class HrApprovalType extends Model
{
    use baseTrait,restaurantScopeTrait;


    protected $rules = array(
        'name'  =>  'required|string|max:255',
        'style' =>  'required|string|max:255',
        'model' =>  ['required','max:255','unique:hr_approval_types'],
    );
public function approvers(){
    return $this->hasMany(HrApprover::class,'hr_approval_type_id');
}

}
