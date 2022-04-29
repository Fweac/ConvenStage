@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier une tâche') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('taches.update', ['id' => $id, 'tache_id' => $tache->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ $tache->nom }}" required autocomplete="nom" autofocus>

                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ $tache->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_fin" class="col-md-4 col-form-label text-md-right">{{ __('Date de fin') }}</label>
                            <div class="col-md-6">
                                <input id="date_fin" type="date" class="form-control @error('date_fin') is-invalid @enderror" name="date_fin" value="{{ $tache->date_fin }}" required autocomplete="date_fin" autofocus>

                                @error('date_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ __('Invité') }}</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option value="" selected>-- Selectionner un invité --</option>
                                @foreach($users as $user)
                                    @if($user_id == $user->id)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                    @if($user->role != 'eleve')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="etat" value="{{ $tache->etat }}">
                        <input type="hidden" name="suivis_id" value="{{ $tache->suivis_id }}">
                        <input type=""hidden name="ordre" value="{{ $tache->ordre }}">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Modifier') }}
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
