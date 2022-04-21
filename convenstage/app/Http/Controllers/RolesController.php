<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Gate::allows('isAdmin')){
            abort(403,"Accès non autorisé");
        }

        $users = User::all();
        return view('roles.index', compact('users'));
    }

    public function show(User $id)
    {
        if(!Gate::allows('isAdmin')){
            abort(403,"Accès non autorisé");
        }

        $user = User::find($id);
        dd($user);

        return view('roles.show', compact('user'));
    }

}
