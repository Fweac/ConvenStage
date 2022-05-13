@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Gestion de suivis') }}</h4>
                    </div>
                    <div class="card-body" style="max-height: 550px; overflow-y: scroll">
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-12">
                                <form class="form-group">
                                    <input type="text" name="search" id="search-user" class="form-control" value="" placeholder="Recherche d'utilisateur">
                                </form>
                                @foreach($suivis as $suivi)
                                    <div class="card mt-3">
                                        <div class="card-body" style="cursor: pointer;" onclick="window.location='{{ route('suivis.show', $suivi->user_id) }}';">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    {{ $users->find($suivi->user_id)->name }}
                                                </div>
                                                <div class="col-md-5">
                                                    <?php
                                                    $count = $taches->where('suivis_id', $suivi->id)->count();
                                                    $valide = 0;
                                                    ?>
                                                    @foreach($taches->where('suivis_id', $suivi->id) as $tache)
                                                        @if($tache->etat == 1)
                                                            <?php $valide = $valide + 1; ?>
                                                        @endif
                                                    @endforeach
                                                    <progress id="etat" max="1" @if($count != 0)value="{{ $valide/$count }}" title="{{ ($valide/$count)*100 }}%" @else title="Aucune tache" @endif></progress>
                                                </div>
                                                <div class="col-md-1">
                                                    <form action="{{ route('taches.create', $suivi->id) }}" method="GET" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-outline-secondary btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Éditer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-1">
                                                    <form action="{{ route('suivis.destroy', $suivi->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <form action="{{ route('suivis.create') }}" method="get">
                                    <button type="submit" class="btn btn-outline-success" title="Ajouter">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                        {{ __('Ajouter') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
