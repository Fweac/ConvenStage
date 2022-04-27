@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card-header">
                <h4>Suivis</h4>
            </div>
            <div class="card-body">
                <table>
                    @foreach($suivis as $suivi)
                        <tr>
                            <td>
                                <a href="{{ route('suivis.show', $suivi->id) }}">{{ $users->find($suivi->user_id)->name }}</a>
                                @foreach($taches->where('suivis_id', $suivi->id) as $tache)
                                    @if($tache->etat == 0)
                                        <span class="alert alert-danger"></span>
                                    @else
                                        <span class="alert alert-success"></span>
                                    @endif
                                @endforeach
                                <hr>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
