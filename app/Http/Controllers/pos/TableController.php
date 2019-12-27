<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::all();
        $tables = Table::all();
        return view('conf.table.index')->with(compact('halls','tables'));

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
            'name' => ['required', 'string', 'unique:tables'],
            'hall' => ['required', 'Integer',],
        ]);

        $table = new Table();
        $table->name = $request->name;
        $table->hall_id = $request->hall;
        if ($request->status == 'on') {
            $table->status = 1;

        } else {
            $table->status = 0;

        }
        $table->save();
        return redirect()->back();
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:tables,name,'.$id],
            'hall' => ['required', 'Integer',],
        ]);


        $table = Table::find($id);
        $table->name = $request->name;
        $table->hall_id = $request->hall;
        if ($request->status == 'on') {
            $table->status = 1;

        } else {
            $table->status = 0;

        }
        $table->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
