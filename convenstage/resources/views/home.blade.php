@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                {{ __('Mon espace') }}
                            </div>
                            <div class="col-md-2">
                                    {{ Auth::user()->role }}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            {{ __('Bienvenue') }} {{ Auth::user()->name }} !
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
