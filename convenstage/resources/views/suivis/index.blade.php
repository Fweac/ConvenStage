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
                                <a href="{{ route('suivis.show', $suivi->id) }}">{{ $suivi->id }}</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
