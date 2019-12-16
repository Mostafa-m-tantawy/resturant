<?php

namespace App\Http\Controllers;

use App\Hall;
use Illuminate\Http\Request;

class PosHallController extends Controller
{
    public function index(){
        $halls=Hall::with(['tables'=>function($q){
            $q->where('status',1);
        }])->where('status',1)->get();
        return view('pos.table.hall')->with(compact('halls'));
    }
}
