@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Suivis') }}
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
                                    <th>{{ __('Etat') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suivis as $suivi)
                                    <tr>
                                        <td>{{ $users->find($suivi->user_id)->name }}</td>
                                        <td>
                                            @foreach($taches->where('suivis_id', $suivi->id) as $tache)
                                                @if($tache->etat == 1)
                                                    <span class="btn btn-success">{{ $tache->date_fin }}</span>
                                                @else
                                                    <span class="btn btn-danger">{{ $tache->date_fin }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <form action="{{ route('suivis.show', $suivi->user_id) }}" method="get" class="d-inline">
                                                <button type="submit" class="btn btn-info">{{ __('Voir') }}</button>
                                            </form>
                                            <form action="{{ route('conventions', $suivi->id) }}" method="GET" class="d-inline">
                                                <button type="submit" class="btn btn-success">{{ __('Convention') }}</button>
                                            </form>
                                            <form action="{{ route('suivis.destroy', $suivi->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Supprimer') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            <tr>
                                <td colspan="3">
                                    <form action="{{ route('suivis.create') }}" method="get">
                                        <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
