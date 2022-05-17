@foreach($users as $user)
    <li class="list-group-item">
        <a class="text-secondary" href="#{{ $user->name }}">{{ $user->name }}</a>
    </li>
@endforeach
