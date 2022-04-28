@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                <td>{{ $tache->etat }}</td>
                                <td>
                                    @if(!(Auth::user()->role == 'eleve'))
                                        <a href="#" class="btn btn-info">{{ __('Voir') }}</a>
                                        <a href="#" class="btn btn-primary">{{ __('Modifier') }}</a>
                                        {{--<form action="{{ route('taches.destroy', $tache->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">{{ __('Supprimer') }}</button>
                                        </form>--}}
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
