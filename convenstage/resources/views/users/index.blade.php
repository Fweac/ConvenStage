@extends('layouts.template')
@section('content')
<h1>Users list</h1>
<ul>
    <hr>
    @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
            </li>
        <hr>
    @endforeach
</ul>
@endsection
