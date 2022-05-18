<?php

namespace App\Http\Controllers;

use App\Models\Convention;
use App\Models\Suivis;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SuivisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        if(Gate::allows('isEleve')){
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas accès à cette page');
        }
        $suivis = Suivis::all();
        $users = User::all();
        $taches = Tache::all();
        return view('suivis.index', compact('suivis' , 'users' , 'taches'));
    }

    public function create()
    {
        if(Gate::allows('isEleve') || Gate::allows('isSecretaire') || Gate::allows('isTuteur')){
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas accès à cette page');
        }
        $users = User::all();
        $suivis = Suivis::all();
        return view('suivis.create', compact('users' , 'suivis'));
    }

    public function store(Request $request)
    {
        if(Gate::allows('isEleve') || Gate::allows('isSecretaire') || Gate::allows('isTuteur')){
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas accès à cette page');
        }
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
        return redirect()->route('taches.create', $suivis->id);
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
        //
    }

    public function update(Request $request, Suivis $suivis)
    {
        //
    }

    public function destroy($id)
    {
        if(Gate::allows('isEleve') || Gate::allows('isSecretaire') || Gate::allows('isTuteur')){
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas accès à cette page');
        }
        $suivis = Suivis::find($id);
        $taches = Tache::all();
        foreach($taches as $tache)
        {
            if($tache->suivis_id == $suivis->id)
            {
                $tache->delete();
            }
        }
        $conventions = Convention::all();
        foreach($conventions as $convention)
        {
            if($convention->suivis_id == $suivis->id)
            {
                File::delete('storage/'.$convention->path);
                $convention->delete();
            }
        }
        $suivis->delete();
        return redirect()->route('suivis')->with('success', 'Suivi supprimé');
    }

    public function search(Request $request)
    {
        $userList = User::all();
        $users = User::where('name', 'like', '%'.$request->user.'%')->get();
        foreach ($users as $user)
        {
            if(Suivis::where('user_id', $user->id)->get()->count() > 0)
            {
                $suivis[] = Suivis::where('user_id', $user->id)->get()[0];
            }
        }
        if(isset($suivis))
        {
            return view('suivis.search', compact('suivis', 'userList'));
        }
        else
        {
            return view('suivis.search', compact('userList'));
        }
    }

    public function tuteurSearch(Request $request)
    {
        $userList = User::all();
        $tacheList = Tache::all();
        $users = User::where('name', 'like', '%'.$request->user.'%')->get();
        foreach ($users as $user)
        {
            if(Suivis::where('user_id', $user->id)->get()->count() > 0)
            {
                $suivis[] = Suivis::where('user_id', $user->id)->get()[0];
            }
        }
        if(isset($suivis))
        {
            return view('suivis.Search', compact('suivis', 'userList', 'tacheList'));
        }
        else
        {
            return view('suivis.Search', compact('userList', 'tacheList'));
        }
    }
}
