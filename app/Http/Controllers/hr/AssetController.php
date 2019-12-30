<?php

namespace App\Http\Controllers;

use App\Asset;
use App\HrEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:index asset'],['only'=>['index']]);
        $this->middleware(['permission:create asset'],['only'=>['create','store']]);
        $this->middleware(['permission:update asset'],['only'=>['edit','update']]);
        $this->middleware(['permission:show asset'],['only'=>['show']]);
        $this->middleware(['permission:delete asset'],['only'=>['destroy']]);
        $this->middleware(['permission:attach employee asset'],['only'=>['attachEmployee']]);
        $this->middleware(['permission:detach employee asset'],['only'=>['detachEmployee']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets=Asset::all();
        return view('hr.asset.index')->with(compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $asset = new Asset();
        if ($asset->validate($data))
        {
       $asset->restaurant_id=Auth::user()->restaurant->id;
       $asset->name=$request->name;
       $asset->description=$request->description;
       $asset->cost=$request->cost;
       $asset->save();
       return redirect()->back();

        }
        else
        {
            $errors = $asset->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset=Asset::find($id);
        $employees=$asset->employees;
        $allEmployees=HrEmployee::all();
        return view('hr.asset.show')
            ->with(compact('asset','employees','allEmployees'));
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

        $data = $request->all();
        $asset =  Asset::find($id);
        if ($asset->validate($data))
        {
            $asset->name=$request->name;
            $asset->description=$request->description;
            $asset->cost=$request->cost;
            $asset->save();
            return redirect()->back();
        }
        else
        {
            $errors = $asset->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asset::destroy($id);
        return  redirect()->back();
    }

    public function attachEmployee(Request $request, $id)
    {
        $asset =  Asset::find($id);
        $asset->employees()->attach($request->employee_id, ['date_of_assignment'=>$request->date_of_assignment,
                'date_of_release'=>$request->date_of_release]);;

        return  redirect()->back();

    }
    public function detachEmployee(Request $request, $id)
    {
        $asset =  Asset::find($id);
        $asset->employees()->detach($request->employee_id);


        return  redirect()->back();

    }

}
