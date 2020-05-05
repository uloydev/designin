<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{

    public function index()
    {
        $agents = User::where('role', 'agent')->paginate(10);
        return view('agent.manage', ['agents' => $agents]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
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
