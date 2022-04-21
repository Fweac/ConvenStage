<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{ $user }}</title>
</head>
<body>
{{ dd($user->role()) }}
<h1>{{ $user }}</h1>
</body>
</html>
