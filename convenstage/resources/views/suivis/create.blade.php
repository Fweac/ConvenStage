@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Élève') }}</h5>
                    </div>
                    <div class="card-body overflow-scroll" style="max-height: 550px;">
                        <form class="form-group mb-2">
                            <input type="text" name="search" id="search-user" class="form-control" value="" placeholder="Recherche d'utilisateur">
                        </form>
                        <ul class="list-group">
                            @foreach($users as $user)
                                @if($user->role == 'eleve')
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-9">
                                                {{ $user->name }}
                                            </div>
                                            <div class="col-md-3">
                                                <?php
                                                $exist = false;
                                                $suiviid = 0;
                                                ?>
                                                @foreach($suivis as $suivi)
                                                    @if($suivi->user_id == $user->id)
                                                        <?php
                                                        $exist = true;
                                                        $suiviid = $suivi->id;
                                                        ?>
                                                    @endif
                                                @endforeach
                                                @if(!$exist)
                                                    <form action="{{ route('suivis.store') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-outline-success btn-sm" title="Ajouter">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('taches.create', $suiviid) }}" method="GET" class="d-inline">
                                                        @csrf
                                                        <button class="btn btn-outline-secondary btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Éditer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h5>{{ __('Édition de tâche') }}</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="offset-md-8 col-md-4">
                                <h5>{{ __('Tâches') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
