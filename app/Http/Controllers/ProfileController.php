<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\UserProfile;
use App\UserPortfolio;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'agent']);
    }

    public function index()
    {
        $profile = Auth::user()->profile;
        if (Route::currentRouteName() == 'agent.profile.index') {
            $listBank = json_decode(File::get('js/bank_indonesia.json'));
            return view('agent.profile', ['profile' => $profile, 'listBank' => $listBank]);
        }
    }

    public function edit()
    {
        $profile = UserProfile::firstWhere('user_id', Auth::id());
        return view('profile.edit')->with('profile', $profile);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'handphone'=> 'required',
            'address'=> 'required',
            'bank'=> 'required',
            'name_card' => 'file|mimetypes:image/jpeg,image/png,image/webp',
            'account_number'=> 'required|numeric'
        ]);

        $user = Auth::user();
        if ($user->role == 'agent') {
            $request->validate([
                'portfolios.*' => 'mimes:jpeg,png,webp'
            ]);
            $profile_data = [
                'handphone'=> $request->handphone,
                'address'=> $request->address,
                'bank'=> $request->bank,
                'account_number'=> $request->account_number,
                'user_id' => $user->id
            ];
            if ($request->hasFile('name_card')) {
                if (!empty($user->profile)) {
                    Storage::delete($user->profile->name_card);
                }
                $name_card = Storage::putFile('uploads/name-card', $request->file('name_card'));
                $profile_data['name_card'] = $name_card;
            }
            if ($request->hasFile('portfolios')) {
                $currentPortfolioCount = $user->profile->portfolio->count();
                $portfolioCount = count($request->file('portfolios')) + $currentPortfolioCount;
                if ($portfolioCount > 10) {
                    $error = ValidationException::withMessages([
                        'portfolios' => ["
                            Sorry portfolio limit is 10 and you already have $currentPortfolioCount portfolio
                        "]
                    ]);
                    throw $error;
                }
                foreach ($request->file('portfolios') as $index => $file) {
                    $portfolio = Storage::putFile('uploads/portfolio', $file);
                    UserPortfolio::create([
                        'title' => $file->getClientOriginalName(),
                        'image_url' => $portfolio,
                        'user_id' => $user->id
                    ]);
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

    public function avatarUpdate(Request $request)
    {
        $request->validate([
            'avatar' => 'bail|required|max:2000|image|'
        ]);
        if ($request->hasFile('avatar')) {
            if (!empty(Auth::user()->profile->avatar)) {
                Storage::delete(Auth::user()->profile->avatar);
            }
            $avatar = $request->file('avatar')->store('public/files');
            UserProfile::updateOrCreate(
                ['user_id' => Auth::id()],
                ['avatar' => $avatar]
            );
        }
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}
