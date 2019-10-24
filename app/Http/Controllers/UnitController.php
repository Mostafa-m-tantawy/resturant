<?php

namespace App\Http\Controllers;

use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->unit_g) {


        }

        $units = Unit::all();
        return view('frontend.units.units')->with(compact('units'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit' => ['required', 'string','unique:units'],
            'child_unit' => ['required', 'string' ],
            'convert_rate' => ['required', 'numeric' ],

        ]);
            $uint = new Unit();
        $uint->restaurant_id = Auth::user()->restaurant->id;
        $uint->unit = $request->unit;
            $uint->child_unit = $request->child_unit;
            $uint->convert_rate = $request->convert_rate;
            $uint->save();


        return redirect('unit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'unit' => ['required', 'string','unique:units,unit,'.$request->id],
            'child_unit' => ['required', 'string' ],
            'convert_rate' => ['required', 'numeric' ],

        ]);
        $uint =Unit::find($request->id);
        $uint->unit = $request->unit;
        $uint->child_unit = $request->child_unit;
        $uint->convert_rate = $request->convert_rate;
        $uint->save();

        return redirect('unit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::destroy($id);
        return redirect('unit');
        //
    }
}
