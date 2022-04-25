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

<form method="POST" action="{{ route('login') }}">
@csrf
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Login</button>
</div>
</form>

</body>
</html>
