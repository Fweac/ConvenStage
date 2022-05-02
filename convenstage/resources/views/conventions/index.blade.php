@extends('layouts.app')
@section('content')
    <embed src="{{asset('storage/'.$convention->path)}}" width="100%" height="100%">
@endsection
