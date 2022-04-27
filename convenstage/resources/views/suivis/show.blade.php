@extends('layouts.app')
@section('content')
    <div class="text-md-center">
        @foreach($taches as $tache)
            {{$tache->nom}}
        @endforeach
    </div>
@endsection
