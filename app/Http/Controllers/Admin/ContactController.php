<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\ContactUs;
use App\Mail\ContactUsNotification;

class ContactController extends Controller
{

    public function index()
    {
        $messages = ContactUs::where('is_answered', false)->latest()->paginate(10);
        $totalAnswered = ContactUs::where('is_answered', true)->count();
        return view('contact-us.read', ['messages' => $messages, 'totalAnswered' => $totalAnswered]);
    }

    public function edit($id)
    {
        $message = ContactUs::findOrFail($id);
        return view('admin.contact.edit', ['message' => $message]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required'
        ]);
        $message = ContactUs::findOrFail($id);
        $message->answer = $request->answer;
        $message->is_answered = true;
        $message->subject_answer = $request->subject;
        $message->save();
        Mail::to($message->email)->send(new ContactUsNotification($message));
        return redirect()->back()->with('success', 'Successfully reply message from customer');
    }

    public function destroy($id)
    {
        ContactUs::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Message Deleted Successfully');
    }

    public function search(Request $request)
    {
        $query = $request->search;
        $messages = ContactUs::whereDate('created_at', 'LIKE', $query)->orWhere('email', 'LIKE', $query)->paginate(10);
        $messages->appends($request->only('search_agent'));
        $totalAnswered = ContactUs::where('is_answered', true)->count();
        return view('contact-us.read', [
            'messages' => $messages,
            'totalAnswered' => $totalAnswered,
            'query' => $query
        ]);
    }
}
