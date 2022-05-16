@if(isset($suivis))
    @foreach($suivis as $suivi)
        <li class="list-group-item">
            <a href="{{ route('suivis.show', $suivi->user_id) }}">
                @foreach($userList as $user)
                    @if($user->id == $suivi->user_id)
                        {{ $user->name }}
                    @endif
                @endforeach
            </a>
        </li>
    @endforeach
@endif
