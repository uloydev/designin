<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{

    public function index()
    {
        $agents = User::where('role', 'agent')->get();
        return view('agent.manage', ['agents' => $agents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agent',
        ]);
        return redirect()->back()->with('success', 'Agent Account Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        return view('agent.show', ['agent', $agent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        return view('agent.edit', ['agent', $agent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'agent_email' => 'required|email',
            'agent_name' => 'required',
            'agent_phone' => 'required',
            'agent_bank' => 'required',
            'agent_account' => 'required|number',
            'agent_address' => 'required'
        ]);
        $agent = User::where('role', 'agent')->findOrFail($id);
        $agent->email = $request->agent_email;
        $agent->name = $request->agent_name;
        $agent->profile->handphone = $request->agent_phone;
        $agent->profile->bank = $request->agent_bank;
        $agent->profile->account_number = $request->agent_account;
        $agent->profile->address = $request->agent_address;
        $agent->profile->save();
        $agent->save();
        return redirect()->back()->with('success', 'Agent Account Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        $profile = $agent->profile;
        $portfolios = $profile->portfolio;
        if ($portfolios->count() != 0) {
            foreach ($portfolios as $portfolio) {
                Storage::delete($portfolio->image_url);
                $portfolio->delete();
            }
        }
        Storage::delete($profile->avatar);
        Storage::delete($profile->name_card);
        $profile->delete();
        $agent->delete();
    }
}
