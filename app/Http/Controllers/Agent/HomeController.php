<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserProfile;

class HomeController extends Controller
{
    public function index()
    {
        return view('agent.home');
    }

    public function showAgentProfile($agent_id)
    {
        $profile = UserProfile::where('user_id', $agent_id)->firstOrFail();
        return view('agent.profile')->with('profile', $profile);
    }
}
