<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ChangeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next)
    {



        if ($request->session()->get('lang')) {
            //

            if(session::get('lang')=='ar'){
                App::setLocale('ar');

            }
            else{
                App::setLocale('en');

            }
        }else{
            App::setLocale('en');

        }


        return $next($request);
    }
}
