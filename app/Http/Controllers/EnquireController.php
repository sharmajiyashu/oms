<?php

namespace App\Http\Controllers;

use App\Models\Enquire;
use App\Models\EnquiryFollowUp;
use App\Models\FollowMaster;
use App\Http\Requests\StoreEnquireRequest;
use App\Http\Requests\UpdateEnquireRequest;
use Illuminate\Http\Request;
use Auth;

class EnquireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Enquire::orderBy('id','desc')->get();
        return view('admin.enquire.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $follow_up = FollowMaster::where('status','Active')->orderby('title','asc')->get();
        return view('admin.enquire.create',compact('follow_up'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEnquireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnquireRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = $request->status;
        $enquire = Enquire::create($data);
        if(!empty($request->follow_date) && !empty($request->follow_comment)){
            EnquiryFollowUp::create(['date' => $request->follow_date ,'note' => $request->follow_comment ,'enquiry_id' => $enquire->id]);  
        }
        return redirect()->route('agent.enquire.index')->with('success','Enquire add success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function show(Enquire $enquire)
    {
        $follow_ups = EnquiryFollowUp::where('enquiry_id',$enquire->id)->get();
        $follow_master = FollowMaster::orderBy('title','asc')->get();
        return view('admin.enquire.show',compact('enquire','follow_ups','follow_master'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquire $enquire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnquireRequest  $request
     * @param  \App\Models\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnquireRequest $request, Enquire $enquire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquire $enquire)
    {
        //
    }

    public function add_follow_up(Request $request){
        if(!empty($request->date) && !empty($request->comment)){
            EnquiryFollowUp::create(['date' => $request->date ,'note' => $request->comment ,'enquiry_id' => $request->enquiry_id,]);
        }
        Enquire::where('id',$request->enquiry_id)->update(['status' => $request->status]);
        return redirect()->back()->with('success','update follow up');
    }

    public function enquires_follow_list(Request $request){
        if(!empty($request->date)){
            $date = $request->date;
        }else{
            $date = date('Y-m-d');
        }
        $data = EnquiryFollowUp::join('enquires','enquires.id','=','enquiry_follow_ups.enquiry_id')
                        ->select('enquires.*')
                        ->where('enquires.user_id',Auth::user()->id)
                        ->where('enquiry_follow_ups.date',$date);
                        if(!empty($request->status)){
                            $data->where('enquires.status',$request->status);
                        }
                        $data = $data->get();
                        
        $date_time = ['date'=>$date ,'status' => $request->status];
        $follow_up_master = FollowMaster::orderBy('title','asc')->get();
        return view('admin.enquire.follows-up-data',compact('data','date_time','follow_up_master'));
    }
}
