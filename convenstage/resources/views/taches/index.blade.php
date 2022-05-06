@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success">
                    <div class="row justify-content-center">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <div class="row justify-content-center">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>
        <div class="row justify-content-center mt-3">
            @foreach($taches as $tache)
                @foreach($users as $user)
                    @if($tache->user_id == $user->id)
                        <?php $user_role = $user->role; ?>
                    @endif
                @endforeach
                @if($tache->etat == 1)
                    <div class="col border list-group-item list-group-item-success">
                        <div class="row">
                            <div class="col-md-10">
                                <p>{{ $tache->nom }}</p>
                            </div>
                            <div class="col-md-2 text-right">
                                @if(!(Auth::user()->role == 'eleve'))
                                    <form action="{{ route('taches.destroyBis', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-close" width="30%" aria-label="Close" type="submit" title="Supprimer"></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>{{ date('d/m/Y',strtotime($tache->date_fin)) }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    @if($tache->date_fin > date('Y-m-d'))
                        <div class="col border @if(Auth::user()->id == $tache->user_id || Auth::user()->role == $user_role)border-primary @endif list-group-item" @if(Auth::user()->id == $tache->user_id || Auth::user()->role == $user_role) style="cursor: pointer;" onclick="window.location='{{ route('taches.show', ['id' => $id, 'tache_id' => $tache->id]) }}';" @endif>
                            <div class="row">
                                <div class="col-md-10">
                                    <p>{{ $tache->nom }}</p>
                                </div>
                                <div class="col-md-2 text-right">
                                    @if(!(Auth::user()->role == 'eleve'))
                                        <form action="{{ route('taches.destroyBis', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-close" width="30%" aria-label="Close" type="submit" title="Supprimer"></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{ date('d/m/Y',strtotime($tache->date_fin)) }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col border @if(Auth::user()->id == $tache->user_id || Auth::user()->role == $user_role)border-primary @endif list-group-item list-group-item-danger" @if(Auth::user()->id == $tache->user_id || Auth::user()->role == $user_role) style="cursor: pointer;" onclick="window.location='{{ route('taches.show', ['id' => $id, 'tache_id' => $tache->id]) }}';" @endif>
                            <div class="row">
                                <div class="col-md-10">
                                    <p>{{ $tache->nom }}</p>
                                </div>
                                <div class="col-md-2 text-right">
                                    @if(!(Auth::user()->role == 'eleve'))
                                        <form action="{{ route('taches.destroyBis', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-close" width="30%" aria-label="Close" type="submit" title="Supprimer"></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{ date('d/m/Y',strtotime($tache->date_fin)) }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="row justify-content-center mb-5">
            @if(!(Auth::user()->role == 'eleve'))
                @foreach($taches as $tache)
                    <div class="col text-center">
                        @if($tache->etat == 0)
                            <form action="{{ route('mails.send', $id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="tache_id" value="{{ $tache->id }}">
                                <button type="submit" class="btn btn-outline-secondary" title="Envoyer un mail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                    </svg>
                                    {{ __('Relancer') }}
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @if(isset($convention))
                    <embed src="{{asset('storage/'.$convention->path)}}" width="100%" height="588">
                @else
                    <div class="alert alert-info">
                        <p>Aucune convention</p>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center">
                        <div class="card-header"><h6>{{ __('Aucune tache sélectionnée') }}</h6></div>
                        <div class="card-body">
                            <div class="container">
                                @if(!(Auth::user()->role == 'eleve'))
                                    <form action="{{ route('taches.create', $id) }} " method="GET" class="d-inline">
                                        @csrf
                                        <div class="form-group row">
                                            <button class="btn btn-outline-success" type="submit" title="Ajouter">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                </svg>
                                                {{ __('Ajouter une tâche') }}
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
