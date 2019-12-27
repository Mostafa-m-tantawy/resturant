<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Order;
use App\OrderDetails;
use App\Table;
use Illuminate\Http\Request;

class PosHallController extends Controller
{
    public function index()
    {
        $halls = Hall::with(['tables' => function ($q) {
            $q->where('status', 1);
        }])->where('status', 1)->get();
        $tables = Table::where('status', 1)->get();
        return view('pos.table.hall')->with(compact('halls', 'tables'));
    }

    public function transfer(Request $request)
    {
        $table = Table::find($request->from);
        $order = Order::find($table->CurrentOrder);
        $order->tables()->sync($request->to);

        return redirect()->back();
    }


    public function merge(Request $request)
    {
        $request->validate([
            'table1' => ['required', 'Integer '],
            'table2' => ['required', 'Integer '],
        ]);

        if ($request->table1 == $request->table2) {
            $error = 'Same table merge';
            return redirect()->back()->withInput()->withErrors($error);
        } else {
            $table1 = Table::find($request->table1);
            $table2 = Table::find($request->table2);
            $order1=Order::find($table1->CurrentOrder);
            $order2=Order::find($table2->CurrentOrder);

            OrderDetails::where('order_id', $order2->id)
                ->update(['order_id' => $order1->id]);
            $order2->tables()->detach();;
            $order2->delete();;
            if ($request->available == 'on') {
                $order1->tables()->sync([$request->table1,$request->table2]);
            } else {
                $order1->tables()->sync($request->table1);
            }
        }
        return redirect()->back();

    }
}
