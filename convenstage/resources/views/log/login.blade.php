<!DOCTYPE html>
<html lang="fr">
<head>
    <title>ConvenStage</title>
    <meta charset="utf-8">
</head>
<body>
@if($errors->any())
    @if($errors->has('email') || $errors->has('password'))
    @else
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif

<form method="POST" action="{{ route('login') }}">
@csrf
<input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if($errors->has('email'))
        <div class="alert alert-danger">
            @foreach($errors->get('email') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
</div>
<div class="form-group">
    @if($errors->has('password'))
        <div class="alert alert-danger">
            @foreach($errors->get('password') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Login</button>
</div>
</form>

</body>
</html>
