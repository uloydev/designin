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
//        $listBank = public_path('js/bank_indonesia.json');
//        $listBank = '{"label": "Bank Mandiri","value": "mandiri","label": "Bank Rakyat Indonesia","value": "bri","label": "BNI (Bank Negara Indonesia) & BNI Syariah","value": "bni"}';
        $listBank = public_path("js/test.json");
        $listBank = json_decode($listBank, true);
        $profile = User::findOrFail(Auth::id());
//        $osi = '{"physical":"cables","data link":"mac address","network":"ip address","transport":"tcp","session":"application connections","presentation":"translation","application":"email"}';
//        $osi = json_decode($osi);
        return view('agent.profile', ['profile' => $profile, 'listBank' => $listBank]);
    }
}
