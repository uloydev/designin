<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use App\UserProfile;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::limit(10)->get();
        return view('agent.home', ['services' => $services]);
    }

    public function showAgentProfile($agent_id)
    {
        $profile = UserProfile::where('user_id', $agent_id)->firstOrFail();
        return view('agent.profile')->with('profile', $profile);
    }
}
