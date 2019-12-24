<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Order;
use App\OrderDetails;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('dashboard');

    }
    public function salesDashboard(Request $request)
    {


        if($request->range) {
                // lenght 10 date = (01/01/2001) =10
                $from = substr($request->range, 0, 10);
                // start  13 date = (01/01/2001 */*)=13
                $to = substr($request->range, 13, 10);
            }else{

                // lenght 10 date = (01/01/2001) =10
                $from = \Carbon\Carbon::today()->format('Y-m-d');
                // start  13 date = (01/01/2001 */*)=13
                $to = \Carbon\Carbon::today()->format('Y-m-d');

            }

       ///  order  details
            $orders = Order::whereBetween('created_at', [$from, $to])->get();
        $total = $orders->sum('grossTotal');
        $sup_total = $orders->sum('SupTotal');
        $vat = $orders->sum('vat');
        $service = $orders->sum('Service');;
        $coupon= $orders->sum('CouponValue');;
        $discount= $orders->sum('discount');;
        $delivery= $orders->sum('delivery');;

        ///top sales dishes
            $orderdetails= OrderDetails::select('dish_size_id', DB::raw('SUM(quantity) as total_points'))
                ->whereBetween('created_at', [$from, $to])
                ->groupBy('dish_size_id')
                ->orderByDESC('total_points')
                ->get();


//dd($orderdetails[0]->dishSize);


        return view('frontend.salesDashboard')
            ->with(compact('total','sup_total',
            'vat','service','orderdetails',
            'from','to','delivery','discount','coupon'

            ));
    }

    public function stockDashboard(Request $request)
    {

        if($request->range) {
        // lenght 10 date = (01/01/2001) =10
        $from = substr($request->range, 0, 10);
        // start  13 date = (01/01/2001 */*)=13
        $to = substr($request->range, 13, 10);
    }else{

        // lenght 10 date = (01/01/2001) =10
        $from = \Carbon\Carbon::today()->format('Y-m-d');
        // start  13 date = (01/01/2001 */*)=13
        $to = \Carbon\Carbon::today()->format('Y-m-d');

    }


        /// stock
        $products=Product::all()->filter(function ($value, $key) {
            return $value['quantity'] <= $value['reorder_point'];
        });

        return view('frontend.stockDashboard')
            ->with(compact('products','from','to'

        ));;

    }
    public function hrDashboard(Request $request)
    {

        if($request->range) {
        // lenght 10 date = (01/01/2001) =10
        $from = substr($request->range, 0, 10);
        // start  13 date = (01/01/2001 */*)=13
        $to = substr($request->range, 13, 10);
    }else{

        // lenght 10 date = (01/01/2001) =10
        $from = \Carbon\Carbon::today()->format('Y-m-d');
        // start  13 date = (01/01/2001 */*)=13
        $to = \Carbon\Carbon::today()->format('Y-m-d');

    }
        return view('hr.hrDashboard') ->with(compact(
            'from','to'

        ));;

    }



    public function posDashboard(Request $request)
    {
        if($request->range) {
        // lenght 10 date = (01/01/2001) =10
        $from = substr($request->range, 0, 10);
        // start  13 date = (01/01/2001 */*)=13
        $to = substr($request->range, 13, 10);
    }else{
        // lenght 10 date = (01/01/2001) =10
        $from = \Carbon\Carbon::today()->format('Y-m-d');
        // start  13 date = (01/01/2001 */*)=13
        $to = \Carbon\Carbon::today()->format('Y-m-d');
    }

        $orders = Order::whereDate('created_at', '>=',$from)
            ->whereDate('created_at', '<=',$to)->get();

        $closedOrders=$orders->where('status','closed')->count();
        $openOrders=$orders->where('status','<>','closed')->count();

        $cash=$orders  ->sum('cash');;
        $credit_card=$orders  ->sum('CreditCard');;
        $check=$orders  ->sum('Check');;
        $account=$orders  ->sum('account');;
        $total_payment=$cash+$credit_card+$check+$account;


        $total = $orders->sum('grossTotal');
        $sup_total = $orders->sum('SupTotal');
        $vat = $orders->sum('vat');
        $service = $orders->sum('Service');;
        $coupon= $orders->sum('CouponValue');;
        $discount= $orders->sum('discount');;
        $delivery= $orders->sum('delivery');;

        return view('pos.dashboard') ->with(compact(
            'from','to','closedOrders','openOrders','orders',
            'check','cash','credit_card','account','delivery','total_payment',
            'sup_total','vat','service','coupon','total','discount'

        ));;

    }

    public function download(Request $request)
    {
        return response()->download($request->url);
    }


    public function changLang(Request $request)
    {
        $acceptLang = ['en','ar'];
        $lang = in_array($request->lang, $acceptLang) ? $request->lang : 'ar';

//        $request->session()->forget('lang');

        if($lang=='ar'){
            session(['lang' => 'ar']);
            App::setLocale('ar');


        }
        else{
            session(['lang' => 'en']);
            App::setLocale('en');


        }


        return back();

    }    public function cashierDashboard()
    {


        return view('cashier.dashboard');

    }
}
