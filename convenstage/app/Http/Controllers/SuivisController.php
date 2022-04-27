<?php

namespace App\Http\Controllers;

use App\Models\Suivis;
use App\Models\User;
use Illuminate\Http\Request;

class SuivisController extends Controller
{
    public function index()
    {
        $suivis = Suivis::all();
        return view('suivis.index', compact('suivis'));
    }

    public function create()
    {
        $users = User::all();
        return view('suivis.create', compact('users'));
    }

    public function store(Request $request)
    {
        $suivis = new Suivis();
        $suivis->user_id = $request->user_id;
        $suivis->suivi = $request->suivi;
        $suivis->save();
        return redirect()->route('suivis.index');
    }

    public function show($id)
    {
        $suivis = Suivis::find($id);
        return view('suivis.show', compact('suivis'));
    }

    public function edit(Suivis $suivis)
    {
        $users = User::all();
        return view('suivis.edit', compact('suivis', 'users'));
    }

    public function update(Request $request, Suivis $suivis)
    {
        $suivis->user_id = $request->user_id;
        $suivis->suivi = $request->suivi;
        $suivis->save();
        return redirect()->route('suivis.index');
    }

    public function destroy(Suivis $suivis)
    {
        $suivis->delete();
        return redirect()->route('suivis.index');
    }
}
