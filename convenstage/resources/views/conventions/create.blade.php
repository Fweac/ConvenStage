@extends('layouts.app')
@section('content')
    @if(isset($convention))
        <embed src="{{asset('storage/'.$convention->path)}}" width="100%" height="100%">
    @else
        <p>pas download</p>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Convention') }}

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
                    <div class="card-body">
                        <form method="POST" action="{{ route('conventions.store', $id),  }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="convention">{{ __('Convention') }}</label>
                                <input type="file" class="form-control @error('convention') is-invalid @enderror" id="convention" name="convention" required>

                                @error('convention')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
