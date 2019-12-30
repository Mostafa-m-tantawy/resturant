<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:index Permission'],['only'=>['index']]);
        $this->middleware(['permission:create Permission'],['only'=>['create','store']]);
        $this->middleware(['permission:update Permission'],['only'=>['edit','update']]);
        $this->middleware(['permission:delete Permission'],['only'=>['destroy']]);
        $this->middleware(['permission:associate Permission role'],['only'=>['association']]);
        $this->middleware(['permission:dissociate Permission role'],['only'=>['dissociation']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::all();
        return  view('conf.permission.permission.index')->with(compact('permissions'));
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
            'name' => 'required|unique:permissions,name',
        ]);


        $permission = Permission::create([
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
        $permission= Permission::find($id);
        $roles=Role::all();
//        dd($permission->roles,$roles);
        return view('conf.permission.permission.show')->with(compact('permission','roles'));
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
            'name' => 'required|unique:permissions,name,'.$id,
        ]);


        $role = Permission::whereId($id)->update([
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
        $permission=Permission::find($id);

        if($permission->roles->count()>0);
        {
            return redirect()->back()->withErrors('Permission has roles!');
        }
        return redirect()->back();

    }    /**
     * association.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function association(Request $request)
    {
        $permission=Permission::find($request->permission_id);
        $permission->roles()->syncWithoutDetaching($request->role_id);

        return redirect()->back();
    }
    public function dissociation(Request $request,$id)
    {
        $permission=Permission::find($request->permission_id);
        $permission->roles()->detach($id);

        return redirect()->back();
    }
}
