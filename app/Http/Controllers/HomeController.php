<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('landing');
    }

    public function serviceSearch(Request $request)
    {
        $query = $request->q;
        $services = Service::where('title', 'like', '%'.$query.'%')->get();
        return view('services', ['services'=>$services]);
    }
}
