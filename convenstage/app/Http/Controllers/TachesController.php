<?php

namespace App\Http\Controllers;

use App\Models\Suivis;
use App\Models\Convention;
use App\Models\Tache;
use App\Models\User;
use App\Mail\SendMailValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class TachesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $taches = Tache::where('suivis_id', $id)->get();
        $convention = Convention::where('suivis_id', $id)->orderBy('ordre', 'desc')->first();
        $users = User::all();
        if(Convention::where('suivis_id', $id)->count() == 0)
        {
            return view('taches.index', compact('taches', 'id', 'users'));
        }
        else
        {
            return view('taches.index', compact('taches', 'id', 'convention', 'users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(Gate::allows('isEleve'))
        {
            return redirect()->route('taches', $id)->with('error', 'Vous n\'avez pas les droits pour créer une tâche');
        }

        $suivis = Suivis::find($id);
        $user_id = $suivis->user_id;
        $taches = Tache::where('suivis_id', $id)->get();
        $count = count($taches);
        $users = User::all();
        $suivis = Suivis::all();
        return view('taches.create', compact('id' , 'users' , 'count', 'user_id', 'suivis', 'taches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('isEleve'))
        {
            return redirect()->route('taches', $request->suivis_id)->with('error', 'Vous n\'avez pas les droits pour créer une tâche');
        }
        $request->validate([
            'nom' => 'required',
            'date_fin' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);
        $tache = new Tache();
        $tache->suivis_id = $request->suivis_id;
        $tache->user_id = $request->user_id;
        $tache->nom = $request->nom;
        $tache->description = $request->description;
        $tache->date_fin = $request->date_fin;
        $tache->ordre = $request->ordre;
        $tache->etat = $request->etat;
        $tache->save();
        return redirect()->route('taches.create', $request->suivis_id)->with('success', 'Tâche ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $tache_id)
    {
        $taches = Tache::where('suivis_id', $id)->get();
        $tacheA = Tache::find($tache_id);
        $convention = Convention::where('suivis_id', $id)->orderBy('ordre', 'desc')->first();
        $users = User::all();
        if(Convention::where('suivis_id', $id)->count() == 0)
        {
            return view('taches.show', compact('taches', 'id', 'tacheA', 'users'));
        }
        else
        {
            return view('taches.show', compact('taches', 'id', 'convention', 'tacheA', 'users'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $tache_id)
    {
        if(Gate::allows('isEleve'))
        {
            return redirect()->route('taches', $id)->with('error', 'Vous n\'avez pas les droits pour modifier une tâche');
        }
        $suivis = Suivis::find($id);
        $user_id = $suivis->user_id;
        $tacheA = Tache::find($tache_id);
        $users = User::all();
        $suivis = Suivis::all();
        $taches = Tache::where('suivis_id', $id)->get();
        return view('taches.edit', compact('tacheA' , 'id' , 'users' , 'user_id', 'suivis' , 'taches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id , $tache_id)
    {
        if(Gate::allows('isEleve'))
        {
            return redirect()->route('taches', $id)->with('error', 'Vous n\'avez pas les droits pour modifier une tâche');
        }
        $request->validate([
            'nom' => 'required',
            'date_fin' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);
        $tache = Tache::find($request->tache_id);
        $tache->nom = $request->nom;
        $tache->description = $request->description;
        $tache->date_fin = $request->date_fin;
        $tache->ordre = $request->ordre;
        $tache->etat = $request->etat;
        $tache->user_id = $request->user_id;
        $tache->save();
        return redirect()->route('taches.create', $id)->with('success', 'Tâche modifiée avec succès');
    }

    public function updateEtat(Request $request, $id, $tache_id)
    {
        $tache = Tache::find($tache_id);
        $taches = Tache::where('suivis_id', $id)->get();
        if($tache->ordre > 1 && $tache->ordre <= count($taches))
        {
            $item = $taches->where('ordre', $tache->ordre-1)->first();
            if($item->etat == 0)
            {
                return redirect()->route('taches', $id)->with('error', 'Vous ne pouvez pas changer l\'état de la tâche car la tâche précédente n\'est pas terminée');
            }
            else
            {
                $tache->etat = 1;
                $tache->save();
                if(($futurT = $taches->where('ordre', $tache->ordre+1)->first()) != null)
                {
                    $destinataire = User::find($futurT->user_id);
                    Mail::to($destinataire->email)->send(new SendMailValidate($destinataire, $futurT));
                }
                return redirect()->route('taches', $id)->with('success', 'État de la tâche modifié avec succès');
            }
        }
        else
        {
            $tache->etat = 1;
            $tache->save();
            if(($futurT = $taches->where('ordre', $tache->ordre+1)->first()) != null)
            {
                $destinataire = User::find($futurT->user_id);
                Mail::to($destinataire->email)->send(new SendMailValidate($destinataire, $futurT));
            }
            return redirect()->route('taches', $id)->with('success', 'État de la tâche modifié avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $tache_id)
    {
        if(Gate::allows('isEleve'))
        {
            return redirect()->route('taches', $id)->with('error', 'Vous n\'avez pas les droits pour supprimer une tâche');
        }
        $tache = Tache::find($tache_id);
        $suivis = Tache::where('suivis_id', $id)->get();
        $suivis = $suivis->where('ordre', '>', $tache->ordre);
        foreach ($suivis as $suivi)
        {
            $suivi->ordre = $suivi->ordre - 1;
            $suivi->save();
        }
        $tache->delete();
        return redirect()->route('taches.create', $id)->with('success', 'Tâche supprimée avec succès');
    }


    public function destroyBis($id, $tache_id)
    {
        if(Gate::allows('isEleve'))
        {
            return redirect()->route('taches', $id)->with('error', 'Vous n\'avez pas les droits pour supprimer une tâche');
        }
        $tache = Tache::find($tache_id);
        $suivis = Tache::where('suivis_id', $id)->get();
        $suivis = $suivis->where('ordre', '>', $tache->ordre);
        foreach ($suivis as $suivi)
        {
            $suivi->ordre = $suivi->ordre - 1;
            $suivi->save();
        }
        $tache->delete();
        return redirect()->route('taches', $id)->with('success', 'Tâche supprimée avec succès');
    }
}
