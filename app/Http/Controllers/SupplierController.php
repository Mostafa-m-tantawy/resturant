<?php

namespace App\Http\Controllers;

use App\Address;
use App\Country;
use App\Phone;
use App\State;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
//        dd($suppliers);
        return view('frontend.supplier.index')->with(compact('suppliers'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::all();
        return view('frontend.supplier.create')->with(compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_g.*.phone' => ['required'],
            'phone_g.*.type' => ['required'],
            'address_g.*.address' => ['required'],
        ]);

        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make(1234);
        $user->save();


        $supplier = new Supplier();
        $supplier->start_balance = $request->balance;
        $supplier->user_id = $user->id;
        $supplier->save();

        if ($request->phone_g) {
            foreach ($request->phone_g as $item) {
                $phone = new Phone();
                $phone->phone = $item['phone'];
                $phone->type = $item['type'];
                $phone->user_id = $user->id;;
                $phone->save();

            }
        }
        if ($request->phone_g) {
            foreach ($request->address_g as $item) {
                if (isset($item['address'])) {
                    $address = new Address();
                    $address->address = $item['address'];
                    if (isset($item['city']))
                        $address->city_id = $item['city'];
                    $address->user_id = $user->id;;
                    $address->save();
                }
            }
        }
        return redirect(route('supplier'));


        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        $payments = $supplier->payment;
        $countries = Country::all();


        return view('frontend.supplier.show')
            ->with(compact('payments', 'supplier', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $supplier = Supplier::findOrFail($id);
        $user = $supplier->user;

        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:users,name,'.$user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_g.*.phone'=> ['required'],
            'phone_g.*.type'=> ['required'],
            'address_g.*.address'=> ['required'],  ]);


        $supplier->start_balance = $request->balance;
        $supplier->save();

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();


        if (is_array($request->phone_g))
            foreach ($request->phone_g as $item) {
                $phone = new Phone();
                $phone->phone = $item['phone'];
                $phone->type = $item['type'];
                $phone->user_id = $user->id;;
                $phone->save();

            }
        if (is_array($request->phone_g))
            foreach ($request->address_g as $item) {
                if (isset($item['address'])) {
                    $address = new Address();
                    $address->address = $item['address'];
                    if (isset($item['city']))
                        $address->city_id = $item['city'];
                    $address->user_id = $user->id;;
                    $address->save();
                }
            }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function states(Request $request)
    {
        $cities = State::where('country_id', $request->id)->get();
        return response()->json($cities, 200);
        //
    }

    public function updateAddress(Request $request)
    {
        $address = Address::findOrFail($request->id);
        $address->address = $request->address;
        $address->city_id = $request->city_id;
        $address->save();
        return redirect()->back();
        //
    }

    public function updatePhone(Request $request)
    {
        $phone = Phone::findOrFail($request->id);
        $phone->phone = $request->phone;
        $phone->type = $request->type;
        $phone->save();
        return redirect()->back();
        //
    }
    public function deleteAddressPhones(Request $request)
    {
        if($request->type =='phone'){
            Phone::destroy($request->id);
        }
        elseif($request->type =='address') {
            Address::destroy($request->id);
        }

        return redirect()->back();
        //
    }
}
