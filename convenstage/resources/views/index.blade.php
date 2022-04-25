<!DOCTYPE html>
<html lang="fr">
<head>
    <title>ConvenStage</title>
    <meta charset="utf-8">
</head>
<body>
@guest()
    <a href="{{ route('login') }}">Connexion</a>
    <a href="{{ route('register') }}">Inscription</a>
@else
    <a href="{{ route('dashboard') }}">Accueil</a>
@endguest

</body>
