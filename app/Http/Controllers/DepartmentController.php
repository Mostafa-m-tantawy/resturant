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
        $departments=Department::where('restaurant_id',$restaurant->id)->get();
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
    {
        $department= Department::findOrFail($id);
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
        $from  =null;
        $to    =null;
        $method=null;
        $restaurant=Auth::user()->restaurant;
        $departments=$restaurant->departments;
        if( $request->isMethod('post')){
            $method=$request->price_math_method;
            $department=$request->department_id;
            if($request->price_math_method!='last_price'){
                // lenght 10 date = (01/01/2001) =10
                $from   =substr($request->rangeofdate,0,10);
                // start  13 date = (01/01/2001 */*)=13
                $to     =substr($request->rangeofdate,13,10);
            }

            $products=Product::whereHas('assignDetails',function ($q)use($department){
                $q->whereHas('assignHeader',function ($qq)use($department){

                    $qq->where('assignable_id',$department)->where('assignable_type','App\Department');
                });
            })->get();


            return view('frontend.department.stock')->with(compact('department','departments','products','from','to','method'));

        }
        return view('frontend.department.stock')->with(compact('departments','from','to','method'));;


    }
}
