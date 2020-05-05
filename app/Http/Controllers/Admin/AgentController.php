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
        $agents = User::where('role', 'agent')->paginate(10);
        return view('agent.manage', ['agents' => $agents]);
    }

    public function create()
    {
        return view('agent.register');
    }

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

    public function show($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        return view('agent.show', ['agent', $agent]);
    }

    public function edit($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        return view('agent.edit', ['agent', $agent]);
    }

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

    public function search(Request $request)
    {
        $agents = User::where([
            ['role', 'agent'],
            ['name', 'LIKE', '%' . $request->search_agent . '%']
        ])->orWhere([
            ['role', 'agent'],
            ['email', 'LIKE', '%' . $request->search_agent . '%']
        ])->paginate(10);
        $agents->appends($request->only('search_agent'));
        return view('agent.manage', ['agents' => $agents]);
    }
}
