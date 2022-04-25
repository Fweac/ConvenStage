@extends('layouts.template')
@section('content')
    <h1>{{ $user->name }}</h1>
    <p>{{ $user->email }}</p>
    @switch($user->role)
        @case('admin')
            <form action="#" method="post">
                @csrf
                <input type="radio" name="role" value="admin" checked> Admin
                <input type="radio" name="role" value="prof"> Prof
                <input type="radio" name="role" value="user"> User
                <input type="submit" value="Modifier">
            </form>
            @break
        @case('prof')
            <form action="#" method="post">
                @csrf
                <input type="radio" name="role" value="admin"> Admin
                <input type="radio" name="role" value="prof" checked> Prof
                <input type="radio" name="role" value="user"> User
                <input type="submit" value="Modifier">
            </form>
            @break
        @case('user')
            <form action="#" method="post">
                @csrf
                <input type="radio" name="role" value="admin"> Admin
                <input type="radio" name="role" value="prof"> Prof
                <input type="radio" name="role" value="user" checked> User
                <input type="submit" value="Modifier">
            </form>
            @break
        @default
            <p>Inconnu</p>
    @endswitch
@endsection
