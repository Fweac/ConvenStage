<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Users list</title>
</head>
<body>
<h1>Users list</h1>
<a href="{{ route('dashboard') }}">dashnoard</a>
<ul>
    <hr>
    @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
            </li>
        <hr>
    @endforeach
</ul>
</body>
</html>
