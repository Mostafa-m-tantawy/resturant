<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PursesPayment;
use App\Uploadedfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function savePayment(Request $request)
    {
        $user=auth()->user();

        $validator = Validator::make($request->all(), [
            'payment' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $pursesPayment = new Payment();
        $pursesPayment->payment_amount = $request->get('payment');
        $pursesPayment->sender_id = $request->get('sender_id');;
        $pursesPayment->receiver_id = $request->get('receiver_id');;
        $pursesPayment->payment_method = $request->payment_method;
        $pursesPayment->note = $request->note;
        $pursesPayment->due_date = $request->due_date;



        if($pursesPayment->save()){
            if ($request->hasFile('file')) {
                $fileToUpload = $request->file('file');
                $filename= date("dmY-his") . $fileToUpload->getClientOriginalName();
                $fulllink = 'uploaded/payment/'.$pursesPayment->receiver_id;
                $fileToUpload->move($fulllink,$filename );

                $file=new Uploadedfile();
                $file->filable_type=get_class($pursesPayment);
                $file->filable_id=$pursesPayment->id;
                $file->url=$fulllink . '/' . $filename;;
                $file->save();
            }
            return redirect()->back();
        }
    }
    public  function deletePayment($id){
        Payment::destroy($id);
        return redirect()->back();
    }

}
