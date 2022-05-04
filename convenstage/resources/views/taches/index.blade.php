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
                    <div class="row">
                        <div class="col-md-10">
                            <p>{{ $tache->nom }}</p>
                        </div>
                        <div class="col-md-2 text-right">
                            @if(!(Auth::user()->role == 'eleve'))
                                <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-close btn-close-white" width="30%" aria-label="Close" type="submit"></button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{ $tache->date_fin }}</p>
                        </div>
                    </div>
                </div>
            @else
                @if($tache->date_fin > date('Y-m-d'))
                    <div class="col border @if(Auth::user()->id == $tache->user_id)border-warning @endif" @if(Auth::user()->id == $tache->user_id) style="cursor: pointer;" onclick="window.location='{{ route('taches.show', ['id' => $id, 'tache_id' => $tache->id]) }}';" @endif>
                        <div class="row">
                            <div class="col-md-10">
                                <p>{{ $tache->nom }}</p>
                            </div>
                            <div class="col-md-2 text-right">
                                @if(!(Auth::user()->role == 'eleve'))
                                    <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-close" width="30%" aria-label="Close" type="submit"></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>{{ $tache->date_fin }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col border @if(Auth::user()->id == $tache->user_id)border-warning @endif bg-danger text-white" @if(Auth::user()->id == $tache->user_id) style="cursor: pointer;" onclick="window.location='{{ route('taches.show', ['id' => $id, 'tache_id' => $tache->id]) }}';" @endif>
                        <div class="row">
                            <div class="col-md-10">
                                <p>{{ $tache->nom }}</p>
                            </div>
                            <div class="col-md-2 text-right">
                                @if(!(Auth::user()->role == 'eleve'))
                                    <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-close btn-close-white" width="30%" aria-label="Close" type="submit"></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>{{ $tache->date_fin }}</p>
                            </div>
                        </div>
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
@endsection
