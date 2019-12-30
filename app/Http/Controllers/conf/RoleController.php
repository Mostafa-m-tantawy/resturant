<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:index role'],['only'=>['index']]);
        $this->middleware(['permission:create role'],['only'=>['create','store']]);
        $this->middleware(['permission:update role'],['only'=>['edit','update']]);
        $this->middleware(['permission:delete role'],['only'=>['destroy']]);
        $this->middleware(['permission:associate role employee'],['only'=>['association']]);
        $this->middleware(['permission:dissociate role employee'],['only'=>['dissociation']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $roles=Role::all();
        return  view('conf.permission.role.index')->with(compact('roles'));
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
            'name' => 'required|unique:roles,name'.(isset($id)?','.$id:''),
        ]);


        $role = Role::create([
            'restaurant_id'=>Auth::user()->restaurant->id,
            'name' => $request->name]);

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
        $role= Role::find($id);
        $permissions=Permission::all();
        $rolePermissions=$role->permissions;
//       dd($rolePermissions);
       return view('conf.permission.role.show')
            ->with(compact('role','permissions','rolePermissions'));

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
            'name' => 'required|unique:roles,name,'.$id,
        ]);


        $role = Role::whereId($id)->update([
            'name' => $request->name]);

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
        $role=Role::find($id);

        if($role->permissions->count()>0);
        {
            return redirect()->back()->withErrors('role has permissions!');
        }
        return redirect()->back();
    }


    public function association(Request $request)
    {
        $role=Role::find($request->role_id);
        $role->permissions()->sync($request->permission_id);

        return redirect()->back();
    }


    public function dissociation(Request $request,$id)
    {
        $role=Role::find($request->role_id);
        $role->permissions()->detach($id);

        return redirect()->back();
    }



}
