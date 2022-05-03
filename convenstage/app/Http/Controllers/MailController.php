<?php

namespace App\Http\Controllers;

use App\Mail\MarkdownMail;
use App\Mail\SendMail;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request, $id)
    {
        $tache_id = $request->input('tache_id');
        $tache = Tache::find($tache_id);
        $user = User::find($tache->user_id);
        Mail::to($user->email)->send(new MarkdownMail($user, $tache));
        return redirect()->route('taches', $id)->with('success', 'Votre message a bien été envoyé');
    }
}
