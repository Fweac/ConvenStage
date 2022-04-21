<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function foo()
    {
        if(!Gate::allows('isAdmin')) {
            abort(403, 'Access denied');
        }

        return view('test.foo');
    }

    public function bar()
    {
        if(!Gate::allows('isProf') && !Gate::allows('isAdmin')) {
            abort(403, 'Access denied');
        }
        return view('test.bar');
    }
}
