<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLabelRequest;
use App\Label;
use danielme85\CConverter\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        //To convert a value
//        $valueNOK = Currency::conv($from = 'USD', $to = 'NOK', $value = 10, $decimals = 2);
//
////To convert a value based on historical data
//        $valueNOK = Currency::conv($from = 'USD', $to = 'NOK', $value = 10, $decimals = 2, $date = '2018-12-24');
//
////to get an array of all the rates associated to a base currency.
//        $rates_usd = Currency::rates(); //defaults to USD
//
//        $rates_nok = Currency::rates('NOK');
//
////Get historical rates
//        $rates__nok_historical = Currency::rates('NOK', '2018-12-24');
//
//        $rates_usd = Currency::rates('NOK');
//
////Get historical rates
//        $rates_nok_historical = Currency::rates('NOK', '2018-12-24');
//
//        dd($valueNOK,$valueNOK,$rates_usd,$rates_nok,$rates_nok_historical);

       $labels = collect(trans('labels'));

        unset($labels['new_label']);

       return view('labels.index',compact('labels'));
    }

    /**
     * Show the form for creating a settings resource.
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
    public function store(AddLabelRequest $request)
    {
        $languages = [
            'en',
            'ar'
        ];
       foreach ($languages as $language){

           $request_request = strtolower($request->name);
           $request_value = ucwords($request->value);

           file_put_contents(resource_path("lang/".$language."/labels.php"),

               str_replace("'new_label'=>'new_label'","'{$request_request}'=>'{$request_value}',\n'new_label'=>'new_label'",
                   file_get_contents(resource_path("lang/".$language."/labels.php"))));
       }

      session()->flash('success','Label added successfully.');

        return back();
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
    public function edit($label_key)
    {
        $label_value = trans('labels')[$label_key];
        return response()->json([
            'name' => $label_key,
            'value' => $label_value]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddLabelRequest $request, $label_value)
    {
        $language = session()->get('locale');
       // dd($label_value,$request->value);

       file_put_contents(resource_path("lang/".$language."/labels.php"),

           str_replace($label_value,$request->value,
               file_get_contents(resource_path("lang/".$language."/labels.php"))));

       session()->flash('success','Label updated successfully.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        if($label->delete()){
            session()->flash('success','Label deleted successfully.');
        }
        else{
            session()->flash('error','error occurred with deleting label.');
        }
        return back();
    }
}
