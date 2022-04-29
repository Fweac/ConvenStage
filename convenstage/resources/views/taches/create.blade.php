@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter une tâche') }}</div>

                <div class="card-body">
                    <form action="{{ route('taches.store', $id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom">{{ __('Nom') }}</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" placeholder="Nom de la tâche">

                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date_fin">{{ __('Date de fin') }}</label>
                            <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin" name="date_fin">

                            @error('date_fin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                        <input type="hidden" name="etat" value="0">
                        <input type="hidden" name="suivis_id" value="{{ $id }}">
                        <input type=""hidden name="ordre" value="{{ $count+1 }}">
                        <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
