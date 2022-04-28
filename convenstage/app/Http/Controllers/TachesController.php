<?php

namespace App\Http\Controllers;

use App\Models\Suivis;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TachesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $taches = Tache::where('suivis_id', $id)->get();
        return view('taches.index', compact('taches', 'id'));
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
        $taches = Tache::where('suivis_id', $id)->get();
        $count = count($taches);
        $user_id = $suivis->user_id;
        return view('taches.create', compact('id' , 'user_id' , 'count'));
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
        $tache = new Tache();
        $tache->suivis_id = $request->suivis_id;
        $tache->user_id = $request->user_id;
        $tache->nom = $request->nom;
        $tache->description = $request->description;
        $tache->date_fin = $request->date_fin;
        $tache->ordre = $request->ordre;
        $tache->etat = $request->etat;
        $tache->type = $request->type;
        $tache->save();
        return redirect()->route('taches', $request->suivis_id)->with('success', 'Tache ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
                return redirect()->route('taches', $id)->with('success', 'Etat de la tâche modifié avec succès');
            }
        }
        else
        {
            $tache->etat = 1;
            $tache->save();
            return redirect()->route('taches', $id)->with('success', 'Etat de la tâche modifié avec succès');
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
        $tache = Tache::find($tache_id);
        $suivis = Tache::where('suivis_id', $id)->get();
        $suivis = $suivis->where('ordre', '>', $tache->ordre);
        foreach ($suivis as $suivi)
        {
            $suivi->ordre = $suivi->ordre - 1;
            $suivi->save();
        }
        $tache->delete();
        return redirect()->route('taches', $id)->with('success', 'Tache supprimée avec succès');
    }
}
