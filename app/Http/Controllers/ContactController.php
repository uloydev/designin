<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact-us.send');
    }

    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        ContactUs::create($request->all());
        return redirect()->route('contact-us.send')
                        ->with('success','Message Has Been Sent.');
    }
}
