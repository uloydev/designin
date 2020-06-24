<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AgentController extends Controller
{

    public function index()
    {
        $listBank = json_decode(File::get('js/bank_indonesia.json'));
        $agents = User::where('role', 'agent')->paginate(10);
        return view('agent.manage', ['agents' => $agents, 'listBank' => $listBank]);
    }

    public function create()
    {
        return view('agent.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'agent_name' => 'required|string',
            'email' => 'required|email:rfc',
            'agent_password' => 'required|min:8|max:20',
            'agent_phone' => 'required',
            'agent_address' => 'required|min:10',
            'name_card' => 'nullable|mimes:doc,docx,pdf',
            'bank' => 'required|integer',
            'agent_account' => 'required|integer'
        ]);
        $agent = User::create([
            'name' => $request->agent_name,
            'email' => $request->agent_email,
            'password' => Hash::make($request->agent_password),
            'username' => Str::snake($request->agent_name),
            'role' => 'agent',
        ]);
        $agent->profile()->create([
            'avatar' => 'files/people.webp',
            'handphone' => $request->agent_phone,
            'address' => $request->agent_address,
            'name_card' => $request->file('name_card')->store('public/files') ?? '',
            'bank' => $request->bank,
            'account_number' => $request->agent_account,
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
            'agent_name' => 'required|string',
            'agent_email' => 'required|email:rfc',
            'agent_password' => 'required|min:8|max:20',
            'agent_phone' => 'required',
            'agent_address' => 'required|min:10',
            'name_card' => 'nullable|mimes:doc,docx,pdf',
            'bank' => 'required',
            'agent_account' => 'required|integer'
        ]);
        $agent = User::findOrFail($id);
        $agent->email = $request->agent_email;
        $agent->name = $request->agent_name;
        $agent->profile->handphone = $request->agent_phone;
        $agent->profile->bank = $request->bank;
        $agent->profile->account_number = $request->agent_account;
        $agent->profile->address = $request->agent_address;
        if ($request->hasFile('name_card')) {
            $agent->profile->name_card = $request->file('name_card')->store('public/files');
        }
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
        $query = $request->search_agent;
        $agents = User::where([
            ['role', 'agent'],
            ['name', 'LIKE', '%' . $query . '%']
        ])->orWhere([
            ['role', 'agent'],
            ['email', 'LIKE', '%' . $query . '%']
        ])->paginate(10);
        $agents->appends($request->only('search_agent'));
        return view('agent.manage', ['agents' => $agents, 'query' => $query]);
    }
}
