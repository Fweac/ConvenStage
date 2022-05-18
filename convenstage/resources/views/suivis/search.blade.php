@if(Auth::user()->role == 'tuteur')
    @if(isset($suivis))
        @foreach($suivis as $suivi)
            <?php
            $afficher = false;
            ?>
            @foreach($tacheList->where('suivis_id', $suivi->id) as $tache)
                @if($tache->user_id == Auth::user()->id)
                    <?php
                    $afficher = true;
                    ?>
                @endif
            @endforeach
            @if($afficher)
                <li class="list-group-item">
                    <a href="{{ route('suivis.show', $suivi->user_id) }}" class="text-secondary">
                        @foreach($userList as $user)
                            @if($user->id == $suivi->user_id)
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </a>
                </li>
            @endif
        @endforeach
    @endif
@else
    @if(isset($suivis))
        @foreach($suivis as $suivi)
            <li class="list-group-item">
                <a href="{{ route('suivis.show', $suivi->user_id) }}" class="text-secondary">
                    @foreach($userList as $user)
                        @if($user->id == $suivi->user_id)
                            {{ $user->name }}
                        @endif
                    @endforeach
                </a>
            </li>
        @endforeach
    @endif
@endif
