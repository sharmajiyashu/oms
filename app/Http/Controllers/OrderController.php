<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\FollowUp;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use DB;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()){
            if(Auth::user()->type == 'admin'){
                $orders = Order::orderBy('id','desc')->get();
                return view('admin.orders.index',compact('orders'));
            }else{
                $orders = Order::orderBy('id','desc')->where('user_id',Auth::user()->id)->get();
                return view('admin.agent.orders.index',compact('orders'));
            }
        }else{
            return redirect('/')->with('error','login now');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();
        if(Auth::user()->type == 'admin'){
            return view('admin.orders.create',compact('cities','states'));
        }else{
            return view('admin.agent.orders.create',compact('cities','states'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $data['product'] = implode(",",$request->product);
        $data['quantity'] = implode(",",$request->quantity);
        $data['quantity'] = implode(",",$request->quantity);
        $data['sh_address'] = $request->sh_address;
        $data['sh_city'] = $request->sh_city;
        $data['sh_state'] = $request->sh_state;
        $data['sh_zip_code'] = $request->sh_zip_code;
        $data['company'] = $request->company;
        $data['bl_address'] = $request->bl_address;
        $data['bl_city'] = $request->bl_city;
        $data['bl_state'] = $request->bl_state;
        $data['bl_zip_code'] = $request->bl_zip_code;
        $data['cellphone'] = $request->cellphone;
        $data['delivery_method'] = $request->delivery_method;
        $data['comment'] = $request->comment;
        $data['order_id'] = $this->generate_orderid();
        $data['user_id'] = Auth::user()->id;
        $order = Order::create($data);

        if(!empty($request->next_follow_date)){
            FollowUp::create(['user_id' => Auth::user()->id ,'order_id' => $order->id ,'type' => 'New' ,'date' => $request->next_follow_date ,'note' => $request->next_follow_comment]);
        }

        if(Auth::user()->type == 'admin'){
            return redirect()->route('admin.orders.index')->with('success','Order Save success');
        }else{
            return redirect()->route('agent.orders.index')->with('success','Order Save success');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();
        return view('admin.orders.edit',compact('order','cities','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();
        $data['product'] = implode(",",$request->product);
        $data['quantity'] = implode(",",$request->quantity);
        $data['quantity'] = implode(",",$request->quantity);
        $data['sh_address'] = $request->sh_address;
        $data['sh_city'] = $request->sh_city;
        $data['sh_state'] = $request->sh_state;
        $data['sh_zip_code'] = $request->sh_zip_code;
        $data['company'] = $request->company;
        $data['bl_address'] = $request->bl_address;
        $data['bl_city'] = $request->bl_city;
        $data['bl_state'] = $request->bl_state;
        $data['bl_zip_code'] = $request->bl_zip_code;
        $data['cellphone'] = $request->cellphone;
        $data['delivery_method'] = $request->delivery_method;
        $data['comment'] = $request->comment;
        $data['tracking_id'] = $request->tracking_id;
        
        Order::where('id',$order->id)->update($data);
        return redirect()->route('admin.orders.index')->with('success','orders update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    function generate_orderid(){
        $coupon = 'ODR'.random_int(10000, 99999);
        if(Order::where('order_id',$coupon)->first()){
            $this->generate_orderid();
        }else{
            return $coupon;
        }
    }

    public function update_tracking_id(Request $request){
        Order::where('id',$request->id)->update(['tracking_id' => $request->tracking_id]);
        return redirect()->back()->with('success','update trancking id');
    }

    public function change_status(Request $request){
        Order::where('id',$request->id)->update(['status' => $request->status, 'reject_reason' => isset($request->reason) ? $request->reason :'']);
        return redirect()->back()->with('success',$request->status.'successfully');
    }
}
