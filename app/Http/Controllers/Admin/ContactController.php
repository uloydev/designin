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
        $totalNotAnswered = ContactUs::where('is_answered', false)->count();
        return view('contact-us.read', [
            'messages' => $messages,
            'totalAnswered' => $totalAnswered,
            'totalNotAnswered' => $totalNotAnswered
        ]);
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
        $message->save();
        Mail::to($message->email)->send(new ContactUsNotification($message));
    }

    public function destroy($id)
    {
        ContactUs::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Message Deleted Successfully');
    }

    public function search(Request $request)
    {
        $searching = $request->search;
        if ($searching == 'is_answered=true') {
            $messages = ContactUs::where('is_answered', true)->latest()->paginate(10);
        }
        else {
            $messages = ContactUs::when($searching, function ($query) use ($searching) {
                $query->where('email', 'LIKE', "%{$searching}%")
                    ->orWhere('name', 'LIKE', "%{$searching}%");
            })->paginate(10);
        }
        $messages->appends($request->only('search'));
        $totalAnswered = ContactUs::where('is_answered', true)->count();
        $totalNotAnswered = ContactUs::where('is_answered', false)->count();
        return view('contact-us.read', [
            'messages' => $messages,
            'totalAnswered' => $totalAnswered,
            'searching' => $searching,
            'totalNotAnswered' => $totalNotAnswered
        ]);
    }
}
