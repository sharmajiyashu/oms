<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\FollowUp;
use App\Models\Company;
use App\Models\Agent;
use App\Models\Product;
use App\Models\FollowMaster;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
        $date_time = ['date_to'=>$request->date_to,'date_from' => $request->date_from ,'status' => $request->status ,'agent_id' => isset($request->agent_id) ? $request->agent_id :''];
        $follow_up_master = FollowMaster::orderBy('title','asc')->get();

        $orders = Order::orderBy('id','desc')->join('users','users.id','=','orders.user_id')
                    ->select('orders.*','users.name');
            if(!empty($request->date_from)){
                if(!empty($request->date_to)){
                    $endDate = $request->date_to;
                }else{
                    $endDate = date('Y-m-d');
                }
                $orders->whereDate('orders.created_at','>=',$request->date_from)->whereDate('orders.created_at','<=',$endDate);
            }
            if(!empty($request->agent_id)){
                $orders->join('agents','agents.user_id','=','users.id');
                $orders->where('agents.id',$request->agent_id);
            }
            
        if(Auth::user()->type == 'admin'){
            $agents = Agent::where('status','Active')->get();
            $orders = $orders->get();
            return view('admin.orders.index',compact('orders','follow_up_master','date_time','agents'));
        }else{
            $orders->where('orders.user_id',Auth::user()->id);
            $orders = $orders->get();
            return view('admin.agent.orders.index',compact('orders','follow_up_master','date_time'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = [];
        $states = [];
        $country = DB::table('countries')->get();
        $company = Company::where('status','Active')->orderby('title','asc')->get();
        $product = Product::where('status','Active')->orderby('title','asc')->get();
        $follow_up = FollowMaster::where('status','Active')->orderby('title','asc')->get();
        if(Auth::user()->type == 'admin'){
            return view('admin.orders.create',compact('cities','states','company','product','follow_up','country'));
        }else{
            return view('admin.agent.orders.create',compact('cities','states','company','product','follow_up','country'));
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
        $amount = 0;
        foreach($request->amount as $item){
            $amount += $item;
        }
        $data = $request->validated();
        $product = [];
        foreach($request->product as $key=>$val){
            if($val == 'other'){
                $val = $request->other_product_name;
            }
            $product[] = $val;
        }

        $data['product'] = implode(",",$product);
        $data['quantity'] = implode(",",$request->quantity);
        $data['quantity'] = implode(",",$request->quantity);
        $data['amounts'] = implode(",",$request->amount);
        $data['amount'] = $amount;
        $data['sh_address'] = $request->sh_address;
        $data['sh_country'] = $request->sh_country;
        $data['sh_city'] = $request->sh_city;
        $data['sh_state'] = $request->sh_state;
        $data['sh_zip_code'] = $request->sh_zip_code;
        $data['company'] = $request->company;
        $data['bl_address'] = $request->bl_address;
        $data['bl_city'] = $request->bl_city;
        $data['bl_state'] = $request->bl_state;
        $data['bl_zip_code'] = $request->bl_zip_code;
        $data['bl_country'] = $request->bl_country;
        $data['cellphone'] = $request->cellphone;
        $data['delivery_method'] = $request->delivery_method;
        $data['comment'] = $request->comment;
        $data['order_id'] = $this->generate_orderid();
        $data['user_id'] = Auth::user()->id;
        $data['follow_up_type'] = $request->follow_up_type;
        $order = Order::create($data);

        if(!empty($request->next_follow_date && !empty($request->next_follow_comment))){
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
        $cities = [];
        $states = [];
        $country = DB::table('countries')->get();
        $company = Company::where('status','Active')->orderby('title','asc')->get();
        $product = Product::where('status','Active')->orderby('title','asc')->get();
        $follow_up = FollowMaster::where('status','Active')->orderby('title','asc')->get();
        return view('admin.orders.edit',compact('order','cities','states','company','product','country','follow_up'));
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
        $amount = 0;
        foreach($request->amount as $item){
            $amount += $item;
        }
        $data = $request->validated();
        $product = [];
        foreach($request->product as $key=>$val){
            if($val == 'other'){
                $val = $request->other_product_name;
            }
            $product[] = $val;
        }
        $data['product'] = implode(",",$product);
        $data['quantity'] = implode(",",$request->quantity);
        $data['quantity'] = implode(",",$request->quantity);
        $data['amounts'] = implode(",",$request->amount);
        $data['amount'] = $amount;
        $data['sh_address'] = $request->sh_address;
        $data['sh_country'] = $request->sh_country;
        $data['sh_city'] = $request->sh_city;
        $data['sh_state'] = $request->sh_state;
        $data['sh_zip_code'] = $request->sh_zip_code;
        $data['company'] = $request->company;
        $data['bl_address'] = $request->bl_address;
        $data['bl_city'] = $request->bl_city;
        $data['bl_state'] = $request->bl_state;
        $data['bl_zip_code'] = $request->bl_zip_code;
        $data['bl_country'] = $request->bl_country;
        $data['cellphone'] = $request->cellphone;
        $data['delivery_method'] = $request->delivery_method;
        $data['comment'] = $request->comment;
        // $data['order_id'] = $this->generate_orderid();
        // $data['user_id'] = Auth::user()->id;
        // $data['follow_up_type'] = $request->follow_up_type;
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
        //5
    }

    function generate_orderid(){
        $coupon = 'TP'.random_int(10000, 99999);
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

    public function export (Request $request){

        $fileName = 'orders'.date('y-m-d').'.csv';
        if(Auth::user()->type == 'admin'){
            $tasks = Order::select('orders.*','users.name as name')->join('users','users.id','=','orders.user_id')->orderBy('id','desc');
        }else{
            $tasks = Order::select('orders.*','users.name as name')->join('users','users.id','=','orders.user_id')->where('users.id',Auth::user()->id)->orderBy('id','desc');
        }

        if(!empty($request->date_from)){
            if(!empty($request->date_to)){
                $endDate = $request->date_to;
            }else{
                $endDate = date('Y-m-d');
            }
            $tasks->whereDate('orders.created_at','>=',$request->date_from)->whereDate('orders.created_at','<=',$endDate);
        }
        if(!empty($request->agent_id)){
            $tasks->join('agents','agents.user_id','=','users.id');
            $tasks->where('agents.id',$request->agent_id);
        }


        $tasks = $tasks->get();
        

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Order ID', 'Status','Agent', 'Customer Type', 'Customer Name', 
            'Shipping Address',
            'Shipping City',
            'Shipping State',
            'Shipping Zip Code',
            'Billing Address',
            'Billing City',
            'Billing State',
            'Billing Zip Code',
            'Mobile',
            'Email',
            'Product',
            'Quantity',
            'Delivery Method',
            'Card Number',
            'Card Exp',
            'Card CVV',
            'Amount',
            'Comment',
            'Reject Reason',
            'Company',
            'Tracking ID',
        );

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {

                if($task->status == 'Accept'){
                    $task->card_number = '************'.$task->card_number[-4].$task->card_number[-3].$task->card_number[-2].$task->card_number[-1];
                    $task->card_cvv = "***";
                    $task->card_exp = "**-**";
                }
                $row['order_id']  = $task->order_id;
                $row['status']    = $task->status;
                $row['name']    = $task->name;
                $row['customer_type']    = $task->customer_type;
                $row['customer_name']  = $task->customer_name;
                $row['sh_address']  = $task->sh_address;
                $row['sh_city']  = $task->sh_city;
                $row['sh_state']  = $task->sh_state;
                $row['sh_zip_code']  = $task->sh_zip_code;
                $row['bl_address']  = $task->bl_address;
                $row['bl_city']  = $task->bl_city;
                $row['bl_state']  = $task->bl_state;
                $row['bl_zip_code']  = $task->bl_zip_code;
                $row['mobile']  = $task->mobile;

                $row['email']  = $task->email;
                $row['product']  = $task->product;
                $row['quantity']  = $task->quantity;
                $row['delivery_method']  = $task->delivery_method;
                $row['card_number']  = $task->card_number;
                $row['card_exp']  = $task->card_exp;
                $row['card_cvv']  = $task->card_cvv;
                $row['amount']  = $task->amount;
                $row['comment']  = $task->comment;
                $row['reject_reason']  = $task->reject_reason;
                $row['company']  = $task->company;
                $row['tracking_id']  = $task->tracking_id;

                fputcsv($file, array($row['order_id'], $row['status'],$row['name'], $row['customer_type'], $row['customer_name'],
                 $row['sh_address'],
                 $row['sh_city'],
                 $row['sh_state'],
                 $row['sh_zip_code'],
                 $row['bl_address'],
                 $row['bl_city'],
                 $row['bl_state'],
                 $row['bl_zip_code'],
                 $row['mobile'],
                 $row['email'],
                 $row['product'],
                 $row['quantity'],
                 $row['delivery_method'],
                 $row['card_number'],
                 $row['card_exp'],
                 $row['card_cvv'],
                 $row['amount'],
                 $row['comment'],
                 $row['reject_reason'],
                 $row['company'],
                 $row['tracking_id'],

                ));
            }

            fclose($file);
        };

        
        return response()->stream($callback, 200, $headers);
    }
}
