<?php
namespace App\Http\Traits;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait baseTrait {


    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);
        if ($v->fails())
        {
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }
    public function errors()
    {
        return $this->errors;
    }

}
