<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\ContactUs;
use App\Mail\ContactUsNotification;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = ContactUs::where('is_answered', '!=', true)->paginate(10);
        return view('admin.contact.index', ['messages' => $messages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = ContactUs::findOrFail($id);
        return view('admin.contact.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required'
        ]);
        $message = ContactUs::findOrFail($id);
        $message->answer = $request->answer;
        $message->is_answered = true;
        $message->save();
        Mail::to($message->email)->send(new ContctUsNotification($message));
        return redirect()->back()->with('success', 'Message Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContactUs::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Message Deleted Successfully');        
    }
}
