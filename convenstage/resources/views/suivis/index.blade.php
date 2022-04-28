@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card-header">
                <h4>Suivis</h4>
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
                <table>
                    @foreach($suivis as $suivi)
                        <tr>
                            <td>
                                <a href="{{ route('suivis.show', $suivi->user_id) }}">{{ $users->find($suivi->user_id)->name }}</a>
                                @foreach($taches->where('suivis_id', $suivi->id) as $tache)
                                    @if($tache->etat == 0)
                                        <span class="alert alert-danger"></span>
                                    @else
                                        <span class="alert alert-success"></span>
                                    @endif
                                @endforeach
                                <form action="{{ route('suivis.destroy', $suivi->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                                <hr>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <form action="{{ route('suivis.create') }}" method="GET">
                                <button type="submit" class="btn btn-primary">Ajouter un suivi</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
