<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function contactUS()
    {
        return view('contact.create');
    }

    public function contactUSPost(Request $request)
    {
        $this->validate($request, [ 'name' => 'required', 'email' => 'required|email', 'message' => 'required' ]);
        Contact::create($request->all());

        /*Mail::send('email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('admin@vconnect.com');
                $message->to('me@info.com', 'Admin')->subject('vConnect Feedback');
            });*/
        return back()->with('success', 'Thanks for contacting us!');
    }

}
