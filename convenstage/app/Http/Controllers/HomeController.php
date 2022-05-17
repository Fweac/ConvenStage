<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()->email_verified_at == null)
        {
            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('welcome');
        }
    }
}
