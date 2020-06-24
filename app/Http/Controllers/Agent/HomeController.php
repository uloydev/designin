<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\Auth;
// use App\Service;
use Illuminate\Http\Request;
use App\UserProfile;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $services = $user->service->sortByDesc('created_at')->take(10);
        $serviceCount = $user->service->count();
        $unfinishedJobCount = $user->agentOrders->where('status', 'process')->count();
        $lastMonthJobCount = $user->agentOrders->where('started_at' ,'>=',Carbon::now()->addDays(-30))->count();
        $orders = Order::where('agent_id', Auth::id())->where(function ($query) {
            $query->where('status', 'process')->orWhere('status', 'complaint');
        })->oldest()->take(10)->get();
        return view('agent.home', [
            'services' => $services,
            'serviceCount' => $serviceCount,
            'unfinishedJobCount'=>$unfinishedJobCount,
            'lastMonthJobCount'=>$lastMonthJobCount,
            'orders' => $orders
        ]);
    }

    public function showAgentProfile($agent_id)
    {
        $profile = UserProfile::where('user_id', $agent_id)->firstOrFail();
        return view('agent.profile')->with('profile', $profile);
    }
}
