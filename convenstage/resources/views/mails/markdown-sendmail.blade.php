@component('mail::message')
# Bonjour {{ $data['user']->name }} !

Vous n'avez toujours pas validé votre tâche **{{ $data['tache']->nom }}**.
Pensez à la valider au plus vite !
Vous pouvez cliquer sur le lien suivant pour valider votre tâche :

@component('mail::button', ['url' => url('/suivis/'.$data['tache']->suivis_id.'/conventions-create')])
Valider ma tâche
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
