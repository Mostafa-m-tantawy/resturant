<?php

namespace App\Http\Controllers;

use App\Address;
use App\Country;
use App\HrEmployee;
use App\Http\Requests\createNewRestaurantRequest;
use App\Phone;
use App\Purse;
use App\Restaurant;
use App\Role;
use App\State;
use App\Supplier;
use App\SystemConf;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:index restaurant'], ['only' => ['index']]);
//        $this->middleware(['permission:create restaurant'],['only'=>['create','store']]);
        $this->middleware(['permission:update restaurant'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:show restaurant'], ['only' => ['show']]);
        $this->middleware(['permission:stock restaurant'], ['only' => ['destroy']]);
    }


    public function index()
    {
//        $branches = Restaurant::where('parent_id', Auth::user()->id)->get();
//        $mainRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
////dd($mainRestaurant);
//        return view('frontend.restaurant.index')->with(compact('branches', 'mainRestaurant'));
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
        return view('frontend.restaurant.create')->with(compact('countries'));
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
            'password' => ['required', 'string', 'confirmed'],
            'phone_g.*.phone' => ['required'],
            'phone_g.*.type' => ['required'],
            'address_g.*.address' => ['required'],
        ]);

        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();


        Auth::login($user);

        $restaurant = new Restaurant;
        $restaurant->user_id = $user->id;
        $restaurant->save();


        $user->restaurant_id = $restaurant->id;
        $user->save();

        Role::create(['restaurant_id'=>$restaurant->id,'name'=>'Super Admin']);

        $employee = new HrEmployee();
        $employee->user_id = $user->id;
        $employee->name = $user->name . ' (Super Admin)';
        $employee->save();


        if ($request->phone_g) {
            foreach ($request->phone_g as $item) {
                $phone = new Phone();
                $phone->phone = $item['phone'];
                $phone->type = $item['type'];
                $phone->user_id = $user->id;;
                $phone->save();
            }
        }
        if ($request->address_g) {
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
        $user->assignRole('Super Admin');

        SystemConf::create(['restaurant_id' => $restaurant->id,
            'name' => 'service', 'value' => '12']);

        SystemConf::create(['restaurant_id' => $restaurant->id,
            'name' => 'vat', 'value' => '14']);

        SystemConf::create(['restaurant_id' => $restaurant->id,
            'name' => 'method', 'value' => 'avg_cost']);

        SystemConf::create(
            ['restaurant_id' => $restaurant->id,
                'name' => 'months', 'value' => '6']);
        SystemConf::create(
            ['restaurant_id' => $restaurant->id,
                'name' => 'delivery', 'value' => '0']);

//        Auth::login($user);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
//dd($restaurant->purchases[0]->restaurant->user);
        $countries = Country::all();
//        dd($restaurant->paySupplier);
        return view('frontend.restaurant.show')
            ->with(compact('restaurant', 'countries'));
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
        $restaurant = Restaurant::findOrFail($id);
        $user = $restaurant->user;

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_g.*.phone' => ['required'],
            'phone_g.*.type' => ['required'],
            'address_g.*.address' => ['required'],]);


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
        if (is_array($request->address_g))
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


    public function stock(Request $request, $id)
    {
        $purchases = Purse::where('restaurant_id', $id)->get();
        $from = null;
        $to = null;
        $method = $request->price_math_method;
        if ($request->price_math_method != 'last_price') {

            // lenght 10 date = (01/01/2001) =10
            $from = substr($request->rangeofdate, 0, 10);
            // start  13 date = (01/01/2001 */*)=13
            $to = substr($request->rangeofdate, 13, 10);
        }

//        return redirect('restaurant/'.$id.'?from='.$from.'&to='.$to.'&method='.$method.'#kt_apps_stock_of_branch');
        return redirect('stock/restaurant/' . $id . '#kt_apps_stock_of_branch')->with(compact('purchases', 'method', 'from', 'to'));

    }


}
