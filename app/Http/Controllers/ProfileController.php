<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index')->with('user', Auth::user());
    }
    
    function edit()
    {
        return view('profile.edit')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'agent') {
            $request->validate([
                'name'=> 'required',
                'email'=> 'required|email',
                'avatar'=> 'mimes:jpg,jpeg,png,gif',
                'handphone'=> 'required',
                'address'=> 'required',
                'name_card'=> 'mimes:jpg,jpeg,png',
                'bank'=> 'required',
                'account_number'=> 'required|number',
                'portfolios.*'=>'mimes:jpg,jpeg,png',
            ]);
        }else{
            $request->validate([
                'name'=> 'required',
                'email'=> 'required|email',
                'avatar'=> 'mimes:jpg,jpeg,png,gif',
                'handphone'=> 'required',
                'address'=> 'required',
                'bank'=> 'required',
                'account_number'=> 'required|number',
            ]);
        }
    }
}
