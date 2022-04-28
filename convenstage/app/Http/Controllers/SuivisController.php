<?php

namespace App\Http\Controllers;

use App\Models\Suivis;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SuivisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Gate::allows('isEleve')){
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
//        dd($request->all());
        $tests = Suivis::all();
        foreach($tests as $test)
        {
            if($test->user_id == $request->user_id)
            {
                return redirect()->route('suivis.create')->with('error', 'Vous avez déjà un suivi pour cette élève');
            }
        }
        $suivis = new Suivis();
        $suivis->user_id = $request->user_id;
        $suivis->save();
        return redirect()->route('suivis')->with('success', 'Suivis créé avec succès');
    }

    public function show($user_id)
    {
        if(count($suivis = Suivis::where('user_id', $user_id)->get()) > 0)
        {
            $suivis = $suivis[0];
            return redirect()->route('taches', $suivis->id);
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
        return redirect()->route('suivis');
    }

    public function destroy($id)
    {
        $suivis = Suivis::find($id);
        $taches = Tache::all();
        foreach($taches as $tache)
        {
            if($tache->suivis_id == $suivis->id)
            {
                $tache->delete();
            }
        }
        $suivis->delete();
        return redirect()->route('suivis')->with('success', 'Suivi supprimé');
    }
}
