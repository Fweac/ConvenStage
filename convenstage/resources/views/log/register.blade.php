<!DOCTYPE html>
<html lang="fr">
<head>
    <title>ConvenStage</title>
    <meta charset="utf-8">
</head>
<body>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
@csrf
<div class="form-group">
    <label for="name">Nom</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nom">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
</div>
<div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
</div>
<div class="form-group">
    <label for="password_confirmation">Confirmation du mot de passe</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation du mot de passe">
</div>
<button type="submit" class="btn btn-primary">S'inscrire</button>
</form>



</body>
</html>
