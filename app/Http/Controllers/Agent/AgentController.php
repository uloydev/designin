<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function profile()
    {
//        $listBank = json_decode(File::get('js/bank_indonesia.json'));
//        $profile = User::findOrFail(Auth::id());
//        return view('agent.profile', ['profile' => $profile, 'listBank' => $listBank]);
    }
}
