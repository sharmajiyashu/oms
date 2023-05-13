<?php

namespace App\Http\Controllers;

use App\Models\FollowMaster;
use App\Http\Requests\StoreFollowMasterRequest;
use App\Http\Requests\UpdateFollowMasterRequest;

class FollowMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FollowMaster::orderBy('title','asc')->get();
        return view('admin.follow-up-master.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.follow-up-master.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFollowMasterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowMasterRequest $request)
    {
        $data = $request->validated();
        FollowMaster::create($data);
        return redirect()->route('admin.follow-up-master.index')->with('success','follow master create success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FollowMaster  $followMaster
     * @return \Illuminate\Http\Response
     */
    public function show(FollowMaster $followMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FollowMaster  $followMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowMaster $followMaster,$id)
    {
        $followMaster = FollowMaster::where('id',$id)->first();
        return view('admin.follow-up-master.edit',compact('followMaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFollowMasterRequest  $request
     * @param  \App\Models\FollowMaster  $followMaster
     * @return \Illuminate\Http\Response
     */
    
    public function update(UpdateFollowMasterRequest $request, FollowMaster $followMaster ,$id)
    {
        $data = $request->validated();
        FollowMaster::where('id',$id)->update($data);
        return redirect()->route('admin.follow-up-master.index')->with('update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FollowMaster  $followMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowMaster $followMaster ,$id)
    {
        FollowMaster::where('id',$id)->delete();
        return redirect()->route('admin.follow-up-master.index')->with('Ddelete success');
    }


}
