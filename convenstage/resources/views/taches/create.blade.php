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
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de la tâche">
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date_fin">{{ __('Date de fin') }}</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin">
                        </div>
                        <div class="form-group">
                            <label for="statut">{{ __('État') }}</label>
                            <select class="form-control" id="etat" name="etat">
                                <option value="0">En cours</option>
                                <option value="1">Terminé</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">{{ __('Type') }}</label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="suivis_id" value="{{ $id }}">
                        <input type=""hidden name="ordre" value="1">
                        <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
