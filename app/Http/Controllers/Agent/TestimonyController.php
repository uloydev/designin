<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Testimony;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Auth::user()->service;
        $testimonies = Testimony::whereIn('service_id', $services->pluck('id'))->paginate(10);
        return view('testimony.agent.index', [
            'testimonies'=>$testimonies, 
            'services' => $services
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($service_id)
    {
        $testimonies = Testimony::where('service_id', $service_id)->paginate(10);
        return view('testimony.agent.show', [
            'testimonies'=>$testimonies
        ]);
    }
}
