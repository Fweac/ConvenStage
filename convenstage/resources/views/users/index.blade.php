@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Utilisateurs') }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('Nom') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Rôle') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @switch($user->role)
                                        @case("admin")
                                        <td>
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="radio" name="role" value="admin" checked> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
{{--                                                <button type="submit" class="btn btn-success">Modifier</button>--}}
                                            </form>
                                        </td>
                                        @break
                                        @case("eleve")
                                        <td>
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve" checked> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
{{--                                                <button type="submit" class="btn btn-success">Modifier</button>--}}
                                            </form>
                                        </td>
                                        @break
                                        @case("responsable")
                                        <td>
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable" checked> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
{{--                                                <button type="submit" class="btn btn-success">Modifier</button>--}}
                                            </form>
                                        </td>
                                        @break
                                        @case("tuteur")
                                        <td>
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur" checked> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
{{--                                                <button type="submit" class="btn btn-success">Modifier</button>--}}
                                            </form>
                                        </td>
                                        @break
                                        @case("secretaire")
                                        <td>
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire" checked> Secretaire
{{--                                                <button type="submit" class="btn btn-success">Modifier</button>--}}
                                            </form>
                                        </td>
                                        @break
                                        @default
                                        <td>
                                            <form action="#" method="POST">
                                                @csrf
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
{{--                                                <button type="submit" class="btn btn-primary">Modifier</button>--}}
                                            </form>
                                        </td>
                                    @endswitch
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Users</h2>

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
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        <form action="{{ route('users.show', $user->id) }}" method="get">
                                            <button type="submit" class="btn btn-info">Afficher</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
