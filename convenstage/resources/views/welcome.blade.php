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
                            <a href="{{ route('login') }}" class="btn btn-outline-success btn-block">{{ __('Connexion') }}</a>
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
                            <a href="{{ route('register') }}" class="btn btn-success btn-block">{{ __('Inscription') }}</a>
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
                            <a href="{{ route('home') }}" class="btn btn-outline-success btn-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                                {{ __('Mon profil') }}
                            </a>
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
                            <a href="{{ route('suivis.show', Auth::user()->id) }}" class="btn btn-success btn-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bezier" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
                                    <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"/>
                                </svg>
                                {{ __('Mon Suivis') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
@endsection
