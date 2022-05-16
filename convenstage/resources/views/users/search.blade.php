@foreach($users as $user)
    <li class="list-group-item">
        <a href="#{{ $user->name }}">{{ $user->name }}</a>
    </li>
@endforeach
