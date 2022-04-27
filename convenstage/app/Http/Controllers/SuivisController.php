<?php

namespace App\Http\Controllers;

use App\Models\Suivis;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SuivisController extends Controller
{
    public function index()
    {
        if(!Gate::allows('isAdmin') && !Gate::allows('isResponsable')){
            abort(403,"Accès non autorisé");
        }
        $suivis = Suivis::all();
        $users = User::all();
        $taches = Tache::all();
        return view('suivis.index', compact('suivis' , 'users' , 'taches'));
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

    public function show($user_id)
    {
        if(count($suivis = Suivis::where('user_id', $user_id)->get()) > 0)
        {
            $suivis = $suivis[0];
            $taches = $suivis->taches;
            return view('suivis.show', compact('suivis' , 'taches'));
        }
        else
        {
            return view('suivis.empty');
        }
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
