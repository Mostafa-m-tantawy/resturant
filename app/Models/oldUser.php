<?php
namespace App;

use Auth;
//use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,  Impersonate; //HasRoles,

    public $detailsMethods = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password','role'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'role'   => 'integer',
        'active' => 'integer'
    ];


    public static $rules = [
        'name'  => 'required|string|max:255',
        'email' => 'email|string|max:255'
    ];


    public function superCan($ability,$model=null){
        if (Auth::user()->hasRole('Super Admin')) {
            return true;
        } else {
        if ($model) {
            $ability = $ability . '_' . str_plural(strtolower(last(explode("\\", class_basename($model)))));
        }
            return $this->getAllPermissions()->pluck('name')->contains($ability);
        }
    }

    public function phones()
    {
        return $this->morphMany('App\Phone', 'phoneable');
    }

    public function address()
    {
        return $this->morphOne('App\Address', 'addressable');
    }
    public function printstations(){
        //->where('disabled',0)
        return $this->belongsToMany('App\Printstation');
    }


    public function receives(){

        return $this->hasMany('App\Safe_transfer','receiver_id');
    }

    public function requests(){

        return $this->hasMany('App\Safe_transfer','sender_id');
    }



    /**
     * @return role
     */
    public function role()
    {
        return $this->role;
    }

    public function active()
    {
        return $this->active;
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function waiterOrders()
    {
        return $this->hasMany(Order::class,'served_by');
    }

    public function waiterOrdersToday()
    {
        return $this->hasMany(Order::class,'served_by')
            ->where('created_at','like',
                \Carbon\Carbon::today()->format('Y-m-d').'%');
    }

    public function kitchenOrders()
    {
        return $this->hasMany(Order::class,'kitchen_id');
    }

    public function kitchenOrderToday()
    {
        return $this->hasMany(Order::class,'kitchen_id')
            ->where('created_at','like',
                \Carbon\Carbon::today()->format('Y-m-d').'%');
    }

    public function tables()
    {
        return $this->hasMany(Assign::class)->where('assignable_type','=','App\Table');
    }
    public function getTotalBalanceAttribute()
    {
        $total_balance = 0;

        //get last approved transfer
        $last_transfer = Safe_transfer::where('is_approved',1)
            ->where('sender_id', $this->id)
            ->orderBy('created_at', 'DESC')
            ->first();

        //get orders from start order to last order
        $orders = Order::where('cashier',$this->id);
        if ($last_transfer) {
            $start_order = Order::find($last_transfer->last_order_id);
            if ($start_order)
                $orders = $orders->where('created_at', '>', $start_order->created_at);

        }

        $orders = $orders->get();

        foreach ($orders as $order) {
            $total_balance += $order->totalPlusPlus;
        }

        return $total_balance+$this->balance;  }

}
