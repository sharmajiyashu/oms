<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use App\Models\Order;
use App\Models\FollowMaster;
use App\Http\Requests\StoreFollowUpRequest;
use App\Http\Requests\UpdateFollowUpRequest;
use Illuminate\Http\Request;
use Auth;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->date)){
            $date = $request->date;
        }else{
            $date = date('Y-m-d');
        }

        $data = FollowUp::orderBy('follow_ups.id','asc')
                ->select('orders.order_id','orders.customer_name','orders.mobile','orders.email','follow_ups.type','follow_ups.date','follow_ups.status','note','orders.follow_up_type')
                ->join('orders','orders.id','=','follow_ups.order_id');
                if(Auth::user()->type != 'admin'){
                    $data->where('orders.user_id',Auth::user()->id);
                }
                $data->where('orders.status','Accept')

                ->where('follow_ups.date',$date);
                if(!empty($request->status)){
                    $data->where('orders.follow_up_type',$request->status);
                }
                $data = $data->get();

                $date_time = ['date'=>$date ,'status' => $request->status];
                $follow_up_master = FollowMaster::orderBy('title','asc')->get();
        return view('admin.agent.follow-up.index',compact('data','date_time','follow_up_master'));
    }

    public function show_detail($id){
        $data = FollowUp::orderBy('follow_ups.id','asc')
                ->select('follow_ups.*')
                ->join('orders','orders.id','=','follow_ups.order_id')
                ->where('orders.order_id',$id)
                ->get();
        $orders = Order::where('order_id',$id)->first();
        $follow_master = FollowMaster::where('status','Active')->get();
        return view('admin.agent.follow-up.show',compact('data','orders','follow_master'));

    }

    public function add_follow_up(Request $request){
        if(!empty($request->date)){
            FollowUp::create(['user_id' => Auth::user()->id ,'date' => $request->date ,'note' => $request->comment ,'order_id' => $request->order_id,'type' => 'New']);
        }
        Order::where('id',$request->order_id)->update(['follow_up_type' => $request->status]);
        return redirect()->back()->with('success','update follow up');
    }

    /**
     * Show the form for creating a new resource.
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
     * @param  \App\Http\Requests\StoreFollowUpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowUpRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUp $followUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUp $followUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFollowUpRequest  $request
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFollowUpRequest $request, FollowUp $followUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUp $followUp)
    {
        //
    }
}
