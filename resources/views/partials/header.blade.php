<header>
    <nav class="navbar navbar-light">
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> -->
        <button id="sidebar-toggler" type="button" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar">
            <ul class="navbar-nav">
                <!-- Notifications -->
                {{-- <li class="nav-item">
                    <a class="nav-link notifications" title="Notifications" href="#"><i class="far fa-bell"></i><span>5</span></a>
                </li> --}}
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-btn profile" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{asset('uploads/avatars/'.$user->avatar)}}" alt="profile picture" title="{{ Auth::user()->name }}">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user/profile') }}"><i class="fas fa-user-circle"></i><span>Profile</span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
