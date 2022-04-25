<ul>
    <li> <a href="{{ route('dashboard') }}">Acuueil</a> </li>
    <li> <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </li>
</ul>
