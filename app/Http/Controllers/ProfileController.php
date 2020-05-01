<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserProfile;
use App\UserPortfolio;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = UserProfile::with('user')->where('user_id', Auth::id())->get();
        return view('profile.index')->with('profile', $profile);
    }
    
    function edit()
    {
        $profile = UserProfile::with('user')->where('user_id', Auth::id())->get();
        return view('profile.edit')->with('profile', $profile);
    }
    
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'avatar'=> 'file|mimes:jpg,jpeg,png,gif',
            'handphone'=> 'required',
            'address'=> 'required',
            'bank'=> 'required',
            'account_number'=> 'required|number',
        ]);
        if ($user->role == 'agent') {
            $request->validate([
                'name_card'=> 'file|mimes:jpg,jpeg,png',
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
            if ($request->hasFile('avatar')) {
                $avatar = Storage::putFile('uploads/avatar', $request->file('avatar'));
                $data['avatar'] = $avatar;
            }
            if ($request->hasFile('name_card')) {
                $name_card = Storage::putFile('uploads/name-card', $request->file('name_card'));
                $data['name_card'] = $name_card;
            }
            if ($request->hasFile('portfolios')) {
                foreach ($request->file('portfolios') as $index => $file) {
                    $portfolio = Storage::putFile('uploads/portfolio', $file);
                    $portfolio_data = [
                        'title'=>$request->titles[$index], 
                        'image_url'=>$portfolio,
                        'user_id'=>$user->id
                    ];
                    UserPortfolio::create($portfolio_data);
                }
            }
        }else{
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
        if(!empty(UserProfile::where('user_id', $user->id)->first())){
            UserProfile::where('user_id', $user->id)->update($data);
        }else{
            UserProfile::create($data);
        }
        return redirect()->back()->with('Profile Updated Successfully');
    }
}
