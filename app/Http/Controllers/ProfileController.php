<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\UserPortfolio;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::with('user')->where('user_id', Auth::user()->id)->get();
        return view('profile.index')->with('profile', $profile);
    }
    
    function edit()
    {
        $profile = Profile::with('user')->where('user_id', Auth::user()->id)->get();
        return view('profile.edit')->with('user', $profile);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'agent') {
            $request->validate([
                'name'=> 'required',
                'email'=> 'required|email',
                'avatar'=> 'file|mimes:jpg,jpeg,png,gif',
                'handphone'=> 'required',
                'address'=> 'required',
                'name_card'=> 'file|mimes:jpg,jpeg,png',
                'bank'=> 'required',
                'account_number'=> 'required|number',
                'portfolios.*'=>'mimes:jpg,jpeg,png',
                'portfolio_titles.*'=>'required_with:portfolios'
            ]);
            $data = [
                'name'=> $request->name,
                'email'=> $request->email,
                'handphone'=> $request->handphone,
                'address'=> $request->address,
                'bank'=> $request->bank,
                'account_number'=> $request->account_number
            ];
            if (!empty($request->avatar)) {
                $avatar = Storage::putFile('uploads/avatar', $request->file('avatar'));
                $data['avatar'] = $avatar;
            }
            if (!empty($request->name_card)) {
                $name_card = Storage::putFile('uploads/name-card', $request->file('name_card'));
                $data['name_card'] = $name_card;
            }
            if (!empty($request->portfolios)) {
                foreach ($request->file('portfolios') as $index => $file) {
                    $portfolio = Storage::putFile('uploads/portfolio', $request->file('portfolio'));
                    $portfolio_data = [
                        'title'=>$request->titles[$index], 
                        'image_url'=>$portfolio,
                        'user_id'=>$user->id
                    ];
                    UserPortfolio::create($portfolio_data);
                }
            }
        }else{
            $request->validate([
                'name'=> 'required',
                'email'=> 'required|email',
                'avatar'=> 'file|mimes:jpg,jpeg,png,gif',
                'handphone'=> 'required',
                'address'=> 'required',
                'bank'=> 'required',
                'account_number'=> 'required|number',
            ]);
            $data = [
                'name'=> $request->name,
                'email'=> $request->email,
                'handphone'=> $request->handphone,
                'address'=> $request->address,
                'bank'=> $request->bank,
                'account_number'=> $request->account_number
            ];
            if ($request->hasFile('avatar')) {
                $avatar = Storage::putFile('uploads/avatar', $request->file('avatar'));
                $data['avatar'] = $avatar;
            }
        }
        if(!empty(Profile::where('user_id', $user->id)->first())){
            Profile::where('user_id', $user->id)->update($data);
        }else{
            Profile::create($data);
        }
        return redirect()->back()->with('Profile Updated Successfully');
    }
}
