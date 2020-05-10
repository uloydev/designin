<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\UserProfile;
use App\UserPortfolio;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified']);
    }

    public function index()
    {
        $profile = UserProfile::firstWhere('user_id', Auth::id());
        if (Route::currentRouteName() == 'agent.profile.index') {
            $listBank = json_decode(File::get('js/bank_indonesia.json'));
            return view('agent.profile', ['profile' => $profile, 'listBank' => $listBank]);
        }
        else if (Route::currentRouteName() == 'user.profile.index') {
            return  view('user.profile', ['profile' => $profile]);
        }
    }

    public function edit()
    {
        $profile = UserProfile::firstWhere('user_id', Auth::id());
        return view('profile.edit')->with('profile', $profile);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'avatar'=> 'file|mimes:jpg,jpeg,png,gif,webp',
            'handphone'=> 'required',
            'address'=> 'required',
            'bank'=> 'required',
            'name_card' => 'file|mimetypes:application/pdf,image/jpeg,image/png,image/webp',
            // 'account_number'=> 'required|number'
            ]);
        if ($user->role == 'agent') {
            $request->validate([
                'portfolios' => 'mimes:jpg,jpeg,png'
                // 'portfolios.*'=>'mimes:jpg,jpeg,png',
                // 'portfolio_titles.*'=>'required_with:portfolios'
            ]);
            $profile_data = [
                'handphone'=> $request->handphone,
                'address'=> $request->address,
                'bank'=> $request->bank,
                'account_number'=> $request->account_number
            ];
            if ($request->hasFile('avatar')) {
                $avatar = Storage::putFile('uploads/avatar', $request->file('avatar'));
                $profile_data['avatar'] = $avatar;
            }
            if ($request->hasFile('name_card')) {
                $name_card = Storage::putFile('uploads/name-card', $request->file('name_card'));
                $profile_data['name_card'] = $name_card;
            }
            if ($request->hasFile('portfolios')) {
                foreach ($request->file('portfolios') as $index => $file) {
                    $portfolio = Storage::putFile('uploads/portfolio', $file);
                    UserPortfolio::updateOrCreate(
                        ['user_id' => $user->id],
                        ['title' => $file->getClientOriginalName(), 'image_url' => $portfolio]
                    );
                }
            }
        }
        $user_data = [
            'name' => $request->name
        ];
        if ($user->email != $request->email){
            $user_data['email'] = $request->email;
            $user_data['email_verified_at'] = NULL;
        }
        $user->update($user_data);
        UserProfile::updateOrCreate(['user_id'=>$user->id], $profile_data);
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}
