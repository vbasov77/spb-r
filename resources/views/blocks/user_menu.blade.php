@if(Auth::user()->isAdmin() || Auth::user()->isModerator())
    <a class="dropdown-item" href="{{route('my.news')}}">Мои новости</a>
@endif
<a class="dropdown-item" href="{{route('profile')}}">Профиль</a>
<a class="dropdown-item" href="{{ route('logout') }}"
   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

