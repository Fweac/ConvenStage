@extends('layouts.template')
@section('content')
{{ __('Vous êtes connecté') }}
@if(Auth::user()->role == 'admin')
    <hr>
    <a href="{{ route('users') }}">Admin Dashboard</a>
@endif
@endsection
