<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
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
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.orders.index',compact('orders'));
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
        return view('admin.orders.create',compact('cities','states'));
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
        Order::create($data);
        return redirect()->route('admin.orders.index')->with('success','Order Save success');
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
        //
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
        //
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
}
