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
                                @if(!(Auth::user()->role == 'eleve' || Auth::user()->role == 'secretaire' || Auth::user()->role == 'tuteur'))
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
                                    @if(!(Auth::user()->role == 'eleve' || Auth::user()->role == 'secretaire' || Auth::user()->role == 'tuteur'))
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
                                    @if(!(Auth::user()->role == 'eleve' || Auth::user()->role == 'secretaire' || Auth::user()->role == 'tuteur'))
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
                                <button type="submit" class="btn btn-outline-secondary" title="Relancer">
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
                        <div class="card-header"><h6>{{ $tacheA->nom }}</h6></div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                {{ $tacheA->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('conventions.store', ['id' => $id, 'tache_id' => $tacheA->id]),  }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="convention">{{ __('Télécharger un PDF') }}</label>
                                        <input type="file" class="form-control @error('convention') is-invalid @enderror" id="convention" name="convention" required>

                                        @error('convention')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                        <button type="submit" class="btn btn-outline-success" title="Envoyer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                            </svg>
                                            {{ __('Envoyer') }}
                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('taches.validate', ['id' => $id, 'tache_id' => $tacheA->id]) }}" method="POST" class="d-inline">
                    @csrf
                    <div class="container mt-3">
                        <div class="form-group row mt-5">
                            <button type="submit" class="btn btn-success" title="Valider">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                </svg>
                                {{ __('Valider la tâche') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
