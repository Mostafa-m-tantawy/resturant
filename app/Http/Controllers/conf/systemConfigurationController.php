<?php

namespace App\Http\Controllers;

use App\SystemConf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class systemConfigurationController extends Controller
{
    public function index(){
        return view('frontend.systemconf.index');
    }
    public function store(Request $request){
        $restaurant= Auth::user()->restaurant;
        SystemConf::where('name', 'vat')    ->where('restaurant_id', $restaurant->id)->update(['value' => $request->vat]);
        SystemConf::where('name', 'service')->where('restaurant_id', $restaurant->id)->update(['value' => $request->service]);
        SystemConf::where('name', 'method') ->where('restaurant_id', $restaurant->id)->update(['value' => $request->methodd]);
        SystemConf::where('name', 'months')  ->where('restaurant_id', $restaurant->id)->update(['value' => $request->months]);
        return redirect('system-configuration');
    }

}
