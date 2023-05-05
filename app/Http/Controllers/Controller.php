<?php

namespace App\Http\Controllers;

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
    
}
