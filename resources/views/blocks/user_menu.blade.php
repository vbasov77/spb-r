@if(Auth::user()->isAdmin() || Auth::user()->isModerator())
    <li>
        <a class="dropdown-item" href="{{route('my.news')}}">Мои новости</a>
    </li>
@endif
<li>
    <a class="dropdown-item" href="{{route('profile')}}">Профиль</a>
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
</li>
<li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>

