@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $user->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
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
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </form>
                                            </td>
                                        @endswitch
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
