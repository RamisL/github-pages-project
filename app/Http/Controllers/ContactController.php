<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public $name;
    public $email;
    public $phone;
    public $msg;

    public function contact()
    {
         return view('contact-us');
    }
    //Input verification
    public function sendEmail(Request $request)
    {
        $details = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|digits:10',
            'msg' => 'required|max:255',
            'g-recaptcha-response' => new Captcha(),
        ]);
        Mail::to('testlucasramis@gmail.com')->send(new ContactMail($details));
        return back()->with('message_sent', 'Your message has been sent successfully !');
    }
}
