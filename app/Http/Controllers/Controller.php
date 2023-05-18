<?php

namespace App\Http\Controllers;

use App\Models\Enquire;
use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function dashboard(){
        if(Auth::check()){
            if(Auth::user()->type == 'admin'){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('agent.dashboard');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function agent_dashboard(){
        $total_enquiry = Enquire::where('user_id',Auth::user()->id)->count();
        $today_enquiry = Enquire::where('user_id',Auth::user()->id)->whereDay('created_at', now()->day)->count();
        $total_orders = Order::where('user_id',Auth::user()->id)->count();
        $today_orders = Order::where('user_id',Auth::user()->id)->whereDay('created_at', now()->day)->count();
        return view('admin.agent.dashboard',compact('total_enquiry','today_enquiry','total_orders','today_orders'));
    }
    
}
