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
                        <form action="{{ route('taches.destroy', ['id' => $id, 'tache_id' => $tache->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn-close btn-close-white" aria-label="Close" type="submit"></button>
                        </form>
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
                    <div class="card-header">{{ $tacheA->nom }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="text-center">
                                <div class="row border mt-3 mb-3">
                                    {{ $tacheA->description }}
                                </div>
                                <form method="POST" action="{{ route('conventions.store', ['id' => $id, 'tache_id' => $tacheA->id]),  }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="convention">{{ __('Télécharger un PDF') }}</label>
                                        <input type="file" class="form-control @error('convention') is-invalid @enderror" id="convention" name="convention" required>

                                        @error('convention')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        <button type="submit" class="btn btn-outline-success">{{ __('Upload') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('taches.validate', ['id' => $id, 'tache_id' => $tacheA->id]) }}" method="POST" class="d-inline">
                    @csrf
                    <div class="container mt-3">
                        <div class="form-group row">
                            <button type="submit" class="btn btn-success">{{ __('Valider la tache') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
