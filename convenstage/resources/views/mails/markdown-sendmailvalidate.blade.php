@component('mail::message')
    # Bonjour {{ $data['user']->name }} !

    Vous Pouvez désormais valider votre tâche **{{ $data['tache']->nom }}**.
    Pensez à la valider au plus vite !
    Vous pouvez cliquer sur le lien suivant pour valider votre tâche :

@component('mail::button', ['url' => url('/suivis/'.$data['tache']->suivis_id.'/taches')])
    Valider ma tâche
@endcomponent
    Merci,<br>
    {{ config('app.name') }}
@endcomponent
