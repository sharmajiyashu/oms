<?php

namespace App\Http\Controllers;

use App\Models\Enquire;
use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Auth;
use Illuminate\Http\Request;
use DB;

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

    public function admin_dashboard(){
        $total_enquiry = Enquire::count();
        $today_enquiry = Enquire::whereDay('created_at', now()->day)->count();
        $total_orders = Order::count();
        $today_orders = Order::whereDay('created_at', now()->day)->count();
        $total_reject_orders = Order::where('status','Reject')->count();
        $today_reject_orders = Order::where('status','Reject')->whereDay('created_at', now()->day)->count();

        return view('admin.agent.dashboard',compact('total_enquiry','today_enquiry','total_orders','today_orders','total_reject_orders','today_reject_orders'));
    }

    public function agent_dashboard(){
        $total_enquiry = Enquire::where('user_id',Auth::user()->id)->count();
        $today_enquiry = Enquire::where('user_id',Auth::user()->id)->whereDay('created_at', now()->day)->count();
        $total_orders = Order::where('user_id',Auth::user()->id)->count();
        $today_orders = Order::where('user_id',Auth::user()->id)->whereDay('created_at', now()->day)->count();
        $total_reject_orders = Order::where('user_id',Auth::user()->id)->where('status','Reject')->count();
        $today_reject_orders = Order::where('user_id',Auth::user()->id)->where('status','Reject')->whereDay('created_at', now()->day)->count();

        return view('admin.agent.dashboard',compact('total_enquiry','today_enquiry','total_orders','today_orders','total_reject_orders','today_reject_orders'));
    }

    public function get_state(Request $request){
        $country_id = $request->id;
        $country = DB::table('countries')->where('name',$country_id)->first();
        $data = DB::table('states')->where('country_id',$country->id)->orderBy('name','asc')->get(['id','name'])->all();
        echo json_encode($data);
    }

    public function get_city(Request $request){
        $country_id = $request->id;
        $states = DB::table('states')->where('name',$country_id)->first();
        $data = DB::table('cities')->where('state_id',$states->id)->orderBy('name','asc')->get(['id','name'])->all();
        echo json_encode($data);
    }

    
}
