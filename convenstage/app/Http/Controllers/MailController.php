<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        Mail::to('toi@toi.fr')->send(new SendMail());
        return view('welcome')->with('success', 'Votre message a bien été envoyé');
    }
}
