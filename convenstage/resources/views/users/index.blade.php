@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11 mt-3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="alert alert-success row justify-content-center" hidden id="alert" role="alert">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Utilisateurs') }}</h5>
                    </div>
                    <div class="card-body overflow-scroll" style="max-height: 550px;">
                        <form class="form-group">
                            <input type="text" name="search" id="search-user" class="form-control" value="" placeholder="Recherche d'utilisateur">
                        </form>
                        <div id="search-result"></div>
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
                                    <td id="{{ $user->name }}">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->id == 1)
                                        <td>{{ __('Administrateur') }}</td>
                                    @else
                                    @switch($user->role)
                                        @case("admin")
                                        <td>
                                            <form action="#" method="POST" class="form_user">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <input type="radio" name="role" value="admin" checked> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
                                            </form>
                                        </td>
                                        @break
                                        @case("eleve")
                                        <td>
                                            <form action="#" method="POST" class="form_user">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve" checked> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
                                            </form>
                                        </td>
                                        @break
                                        @case("responsable")
                                        <td>
                                            <form action="#" method="POST" class="form_user">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable" checked> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
                                            </form>
                                        </td>
                                        @break
                                        @case("tuteur")
                                        <td>
                                            <form action="#" method="POST" class="form_user">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur" checked> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
                                            </form>
                                        </td>
                                        @break
                                        @case("secretaire")
                                        <td>
                                            <form action="#" method="POST" class="form_user">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire" checked> Secretaire
                                            </form>
                                        </td>
                                        @break
                                        @default
                                        <td>
                                            <form action="#" method="POST" class="form_user">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <input type="radio" name="role" value="admin"> Admin
                                                <input type="radio" name="role" value="eleve"> Eleve
                                                <input type="radio" name="role" value="responsable"> Responsable
                                                <input type="radio" name="role" value="tuteur"> Tuteur
                                                <input type="radio" name="role" value="secretaire"> Secretaire
                                            </form>
                                        </td>
                                    @endswitch
                                    @endif
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
