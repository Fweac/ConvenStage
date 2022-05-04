<?php

namespace App\Http\Controllers;

use App\Models\Convention;
use App\Models\Suivis;
use Illuminate\Http\Request;

class ConventionsController extends Controller
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
        $convention = Convention::where('suivis_id', $id)->orderBy('ordre', 'desc')->first();
        if($convention != null)
        {
            return view('conventions.index', compact('convention'));
        }
        else
        {
            return redirect()->route('suivis')->with('error', 'Aucune convention n\'a été trouvée pour ce suivi.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $convention = Convention::where('suivis_id', $id)->orderBy('ordre', 'desc')->first();
        if(Convention::where('suivis_id', $id)->count() == 0)
        {
            return view('conventions.create', compact('id'));
        }
        else
        {
            return view('conventions.create', compact('id', 'convention'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $tache_id)
    {
        $request->validate([
            'convention' => 'required',
        ]);

        if($request->convention->extension() == 'pdf')
        {
            $convention = Convention::where('suivis_id', $id)->orderBy('ordre', 'desc')->first();
            if($convention != null)
            {
                $ordre = Convention::where('suivis_id', $id)->count() + 1;
            }
            else
            {
                $ordre = 1;
            }

            $convention = new Convention();
            $convention->suivis_id = $id;
            $convention->ordre = $ordre;
            $convention->path = $request->convention->storeAs('conventions', $id . '_' . $ordre . '.' . $request->convention->extension(), 'public');
            $convention->save();

            return redirect()->route('taches.show', ['id' => $id, 'tache_id' => $tache_id])->with('success', 'La convention a bien été ajoutée.');
        }
        else
        {
            return redirect()->route('taches.show', ['id' => $id, 'tache_id' => $tache_id])->with('error', 'Le fichier n\'est pas un PDF.');
        }
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
