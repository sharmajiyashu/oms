<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use Hash;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::orderBy('id','desc')->get();
        return view('admin.agent.index',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgentRequest $request)
    {
        $data  = $request->validated();
        $data['address'] = $request->address;
        $user = User::create(['name' => $request->firstname ,'email' => $request->email ,'type' => 'agent','image' => '-' ,'password' => Hash::make($request->password)]);        
        $data['user_id'] = $user->id;
        Agent::create($data);
        return redirect()->route('admin.agent.index')->with('success','Agent Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        return view('admin.agent.edit',compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentRequest  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        $data = $request->validated();
        $data['address'] = $request->address;
        $agent->update($data);

        if(!empty($request->password)){
            User::where('id',$agent->user_id)->update(['password' => Hash::make($request->password)]);
        }
        return redirect()->route('admin.agent.index')->with('success','Agent update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Agent $agent)
    {
        User::where('id',$agent->user_id)->delete();
        $agent->delete();
        return redirect()->route('admin.agent.index')->with('success','Agent delete success.');
    }
}
