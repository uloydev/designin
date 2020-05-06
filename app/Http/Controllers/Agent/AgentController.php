<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgentController extends Controller
{
    public function profile()
    {
        $listBank = 'js/bank_indonesia.json';
        $listBank = json_decode(File::get($listBank));
        $profile = User::findOrFail(Auth::id());
        return view('agent.profile', ['profile' => $profile, 'listBank' => $listBank]);
    }
}
