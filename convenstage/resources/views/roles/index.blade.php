<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Roles</title>
</head>
<body>
    <h1>Roles</h1>
    <br>
    <hr>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @foreach($users as $user)
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $user->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $user->email }}</p>
                        <p>{{ $user->role->name }}</p>
                        <form action="{{ route('roles.show') }}" method="post">
                            @csrf
                            <button type="submit" value="{{ $user->id }}" style="border-width: 2px; border-color: black">voir</button>
                    </div>
                </div>
                <br>
                <hr>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>

