<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Order;
use App\Models\ServiceAppointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::check()){
            if(Auth::user()->hasRole('Customer')){
                Session::flush();
                Auth::logout();
                return Redirect('/login')->with('error','Oppes! You have entered invalid credentials');
            }else{
                if(Auth::user()->hasRole('Supervisor')){
                    $supervisor = User::find(Auth::id());
        
                    $staffIds = $supervisor->staffSupervisor->pluck('user_id')->toArray();
        
                    $orders = Order::whereIn('service_staff_id', $staffIds)
                        ->take(10)->get(); 
        
                }elseif(Auth::user()->hasRole('Staff')){
                    $orders = Order::where('service_staff_id',Auth::id())->take(10)->get();
                    // dd($orders);
                }else{
                    $orders = Order::orderBy('id','DESC')->take(10)->get();
                }
                
                $affiliate_transaction = DB::table('transactions')
                ->join('affiliates', 'transactions.user_id', '=', 'affiliates.user_id')
                ->select(DB::raw('SUM(transactions.amount) as amount'))
                ->groupBy('affiliates.user_id')
                ->get();
        
                $affiliate_commission = 0;
                
                foreach($affiliate_transaction as $transaction){
                    $affiliate_commission = $affiliate_commission + $transaction->amount;
                }
        
                $staff_transaction = DB::table('transactions')
                ->join('staff', 'transactions.user_id', '=', 'staff.user_id')
                ->select(DB::raw('SUM(transactions.amount) as amount'))
                ->groupBy('staff.user_id')
                ->get();
        
                $staff_commission = 0;
                
                foreach($staff_transaction as $transaction){
                    $staff_commission = $staff_commission + $transaction->amount;
                }
        
                $order = Order::get();
                
                $sale = 0;
        
                foreach($order as $single_order){
                    $sale = $sale + $single_order->total_amount;
                }
        
                $appointments = ServiceAppointment::latest()->take(5)->get();
        
                $i = 0;
                return view('home',compact('orders','affiliate_commission','staff_commission','sale','appointments','i'));  
            }
        }

        
    }
}
