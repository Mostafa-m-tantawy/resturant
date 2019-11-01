<?php

namespace App\Http\Controllers;

use App\Department;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use vendor\project\StatusTest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant=Auth::user()->restaurant;
        $departments=Department::all();
        return  view('frontend.department.index')->with(compact('restaurant','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('frontend.department.create');
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
            'name' => ['required', 'string','unique:departments'],
            'description' => ['nullable', 'string'],
            ]);


        $department=new Department();
        $department->name=$request->name;
        $department->description=$request->description;
        $department->restaurant_id=Auth::user()->restaurant->id;
        $department->save();
        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department= Department::findOrFail($id);
        return view('frontend.department.show')->with(compact('department'));

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
    {        $department= Department::findOrFail($id);

        $request->valid1ate([
            'name' => ['required', 'string', 'max:255','unique:departments,name,'.$department->id],
            'description' => ['nullable', 'string'],
            ]);


        $department->name=$request->name;
        $department->description=$request->description;
        $department->save();
        return redirect()->route('department.index');
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
    public function stock(Request $request)
    {
        $restaurant=Auth::user()->restaurant;
        $departments=$restaurant->departments;
        if( $request->isMethod('post')){
           $department=Department::find($request->department_id);
            $products=Product::whereHas('assignDetails',function ($q)use($department){
                $q->whereHas('assignHeader',function ($qq)use($department){

                    $qq->where('assignable_id',$department->id)->where('assignable_type','App\Department');
                });
            })->get();
            return view('frontend.department.stock')->with(compact('department','departments','products'));
        }
        return view('frontend.department.stock')->with(compact('departments'));;
    }
}
