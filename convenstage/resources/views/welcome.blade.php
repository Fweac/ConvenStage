@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-md-5 text-center">
                <h1>Bienvenue</h1>
                <h5>sur l'application web <u>ConvenStage</u></h5>
                <p style="opacity: 0.60">L'application pour savoir précisément où en sont vos procédures !</p>
            </div>
        </div>
        @guest()
            <div class="row justify-content-center mt-5">
                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h5>Connexion</h5>
                        </div>
                        <div class="card-body">
                            <h6>Vous possédez déjà un compte ?</h6>
                            <br>
                            <p>Connectez-vous pour pouvoir gérer vos procédures !</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-success btn-block">Connexion</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h5>Inscription</h5>
                        </div>
                        <div class="card-body">
                            <h6>Vous ne possédez pas de compte ?</h6>
                            <br>
                            <p>Inscrivez vous pour pouvoir profiter de nos services !</p>
                            <a href="{{ route('register') }}" class="btn btn-success btn-block">Inscription</a>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
        @auth()
            <div class="row justify-content-center mt-5">
                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h5>Profil</h5>
                        </div>
                        <div class="card-body">
                            <h6>Vous souhaitez gérer votre profil ?</h6>
                            <br>
                            <p>Cliquez sur le bouton ci-dessous pour modifier votre profil !</p>
                            <a href="{{ route('home') }}" class="btn btn-outline-success btn-block">Gérer votre profil</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="card">
                        <div class="card-header">
                            <h5>Suivis</h5>
                        </div>
                        <div class="card-body">
                            <h6>Vous voulez effectuer vos tâches ?</h6>
                            <br>
                            <p>Cliquez sur le bouton ci-dessous pour effectuer vos tâches !</p>
                            <a href="{{ route('suivis.show', Auth::user()->id) }}" class="btn btn-success btn-block">Suivis</a>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
@endsection
