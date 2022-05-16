<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
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
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas accès à cette page');
        }
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Gate::allows('isAdmin')){
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas accès à cette page');
        }
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
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
    public function update(Request $request)
    {
        if(!Gate::allows('isAdmin')){
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas accès à cette page');
        }
        $user = User::find($request->id);
        $user->update($request->all());
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Utilisateur modifié avec succès',
            ]
        );
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

    public function search(Request $request)
    {
        $users = User::where('name', 'like', '%'.$request->user.'%')->get();
        return view('users.search', compact('users'));
    }

    public function eleveSearch(Request $request)
    {
        $users = User::where('name', 'like', '%'.$request->user.'%')->where('role', '=', 'eleve')->get();
        return view('users.search', compact('users'));
    }
}
