<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Testimony;
use App\Service;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonies = Testimony::where('user_id', User::id())->paginate(10);
        return view('testimony.user.index', ['testimonies' => $testimonies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Service $service)
    {
        return view('testimony.user.create', ['service'=>$service]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        $request->validate([
            'content' => 'required',
            'rating' => 'required|digits_between:0,10',
        ]);
        $testimony = new Testimony;
        $testimony->content = $request->content;
        $testimony->rating = $request->rating;
        $testimony->service_id = $service->id;
        $testimony->user_id = Auth::id();
        $testimony->save();
        return redirect()->back()->with('success', 'Testimony Submitted Successfully');
    }
}