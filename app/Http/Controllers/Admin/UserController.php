<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('user.manage', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register');
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
            'role' => 'user',
        ]);
        return redirect()->back()->with('success', 'User Account Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        return view('user.show', ['user', $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        return view('user.edit', ['user', $user]);
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
            'user_email' => 'required|email',
            'user_name' => 'required',
            'user_phone' => 'required',
            'user_bank' => 'required',
            'user_account' => 'required|number',
            'user_address' => 'required'
        ]);
        $user = User::where('role', 'user')->findOrFail($id);
        $user->email = $request->user_email;
        $user->name = $request->user_name;
        $user->profile->handphone = $request->user_phone;
        $user->profile->bank = $request->user_bank;
        $user->profile->account_number = $request->user_account;
        $user->profile->address = $request->user_address;
        $user->profile->save();
        $user->save();
        return redirect()->back()->with('success', 'User Account Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $profile = $user->profile;
        Storage::delete($profile->avatar);
        Storage::delete($profile->name_card);
        $profile->delete();
        $user->delete();
    }
}
