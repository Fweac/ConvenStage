@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter un suivi') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('suivis.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="eleve" class="col-md-4 col-form-label text-md-right">{{ __('Eleve') }}</label>

                            <div class="col-md-6">
                                <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id" required>
                                    <option value="">-- Selectionner un eleve --</option>
                                    @foreach($users as $user)
                                        @if($user->role == 'eleve')
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Ajouter') }}
                            </button>

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
