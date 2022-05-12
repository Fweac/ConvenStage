@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{session('success')}}
                </div>
            @endif
            @foreach($conventions as $convention)
                <div class="col-md-4">
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-11">
                                    <h5>{{ $convention->ordre }}</h5>
                                </div>
                                <div class="col-md-1">
                                    <form action="{{ route('conventions.destroy', $convention->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $convention->id }}">
                                        <button type="submit" class="btn btn-close"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><embed src="{{asset('storage/'.$convention->path)}}" width="100%" height="558px"></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
