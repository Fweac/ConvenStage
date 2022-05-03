<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Bonjour {{ $data['user']->name }}</h1>
    <p>Vous n'avez toujours pas validé votre tache '{{ $data['tache']->nom }}'.</p>
    <p>Veuillez cliquer sur le lien ci-dessous pour valider votre tache.</p>
    <a href="{{ url('/suivis/'.$data['tache']->suivis_id.'/conventions-create') }}">Valider</a>
</body>
</html>
