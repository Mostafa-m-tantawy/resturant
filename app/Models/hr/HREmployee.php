<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HREmployee extends Model
{
    protected $rules = array(


        'name' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone_g.*.phone' => ['required'],
        'phone_g.*.type' => ['required'],
        'address_g.*.address' => ['required'],

    );


}
