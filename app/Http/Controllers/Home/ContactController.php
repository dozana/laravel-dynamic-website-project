<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function contact()
    {
        return view('site.contact');
    }

    public function storeMessage(Request $request)
    {
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Your Message Submitted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function contactMessage()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.all_contact', compact('contacts'));
    }

    public function deleteMessage($id)
    {
        Contact::findOrFail($id)->delete();

        $notification = [
            'message' => 'Your Message Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
