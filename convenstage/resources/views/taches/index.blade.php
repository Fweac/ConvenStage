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
    <div class="row justify-content-center">
        @foreach($taches as $tache)
            @if($tache->etat == 1)
                <div class="col border bg-success text-white">
                    @if(!(Auth::user()->role == 'eleve'))
                        <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn-close btn-close-white" aria-label="Close" type="submit"></button>
                        </form>
                    @endif
                    <p>{{ $tache->nom }}</p>
                    <p>{{ $tache->date_fin }}</p>
                </div>
            @else
                @if($tache->date_fin > date('Y-m-d'))
                    <div class="col border" @if(Auth::user()->id == $tache->user_id) style="cursor: pointer;" onclick="window.location='{{ route('taches.show', ['id' => $id, 'tache_id' => $tache->id]) }}';" @endif>
                        <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn-close" aria-label="Close" type="submit"></button>
                        </form>
                        <p>{{ $tache->nom }}</p>
                        <p>{{ $tache->date_fin }}</p>
                    </div>
                @else
                    <div class="col border bg-danger text-white" @if(Auth::user()->id == $tache->user_id) style="cursor: pointer;" onclick="window.location='{{ route('taches.show', ['id' => $id, 'tache_id' => $tache->id]) }}';" @endif>
                        <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn-close btn-close-white" aria-label="Close" type="submit"></button>
                        </form>
                        <p>{{ $tache->nom }}</p>
                        <p>{{ $tache->date_fin }}</p>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
    <div class="row justify-content-center mb-5">
        @foreach($taches as $tache)
             <div class="col text-center">
             @if($tache->etat == 0)
                <form action="{{ route('mails.send', $id) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="tache_id" value="{{ $tache->id }}">
                    <button type="submit" class="btn btn-outline-secondary">{{ __('Relancer') }}</button>
                </form>
             @endif
             </div>
        @endforeach
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
                <div class="card-header">{{ __('Aucune tache sélectionnée') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="text-center">
                            <form action="{{ route('taches.create', $id) }} " method="GET" class="d-inline">
                                @csrf
                                <div class="form-group row">
                                    <button class="btn btn-outline-success" type="submit">{{ __('Ajouter une tache') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Taches') }}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Nom') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Date de fin') }}</th>
                                <th>{{ __('Etat') }}</th>
                                @if(!(Auth::user()->role == 'eleve'))
                                    <th>{{ __('Actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($taches as $tache)
                            <tr>
                                <td>{{ $tache->nom }}</td>
                                <td>{{ $tache->description }}</td>
                                <td>{{ $tache->date_fin }}</td>
                                <td>
                                    @if($tache->etat == 0)
                                        En cours
                                    @else
                                        Terminée
                                    @endif
                                </td>
                                <td>
                                    @if(!(Auth::user()->role == 'eleve'))
                                        @if(Auth::user()->id == $tache->user_id)
                                            <form action="{{ route('conventions.create', $id) }}" method="GET" class="d-inline">
                                                <button type="submit" class="btn btn-info">{{ __('Remplir') }}</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('taches.edit', ['id' => $id, 'tache_id' => $tache->id]) }}" method="GET" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">{{ __('Modifier') }}</button>
                                        </form>
                                        <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">{{ __('Supprimer') }}</button>
                                        </form>

                                        <!-- Changement d'état -->
                                        <form action="{{ route('taches.validate', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success" type="submit">{{ __('Valider') }}</button>
                                        </form>

                                        <form action="{{ route('mails.send', $id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="tache_id" value="{{ $tache->id }}">
                                            <button type="submit" class="btn btn-warning">{{ __('Envoyer un mail') }}</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @if(!(Auth::user()->role == 'eleve'))
                                <tr>
                                    <td colspan="5">
                                        <form action="{{ route('taches.create', $id) }} " method="GET" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success" type="submit">{{ __('Ajouter') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
