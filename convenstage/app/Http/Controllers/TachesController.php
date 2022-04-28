<?php

namespace App\Http\Controllers;

use App\Models\Suivis;
use App\Models\Tache;
use Illuminate\Http\Request;

class TachesController extends Controller
{
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
        $suivis = Suivis::find($id);
        $user_id = $suivis->user_id;
        return view('taches.create', compact('id' , 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
