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

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        ContactUs::create($request->all());
        return redirect()->back()->with(
            'success', 'Your message has been sent! Please wait maximum 24 hours on your email'
        );
    }
}
