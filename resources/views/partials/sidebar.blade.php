<div class="sidebar">
    <div class="logo">
        <a href="{{ route('home') }}">
            <!-- {{ config('app.name', 'Laravel') }} -->
            <img src="{{asset('images/activity-system-logo-full.png')}}" alt="Activity System Logo">
        </a>
    </div>
    <nav class="navbar navbar-light">
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                @can('manage-users')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts-manage') }}">
                            <i class="fal fa-newspaper"></i>
                            <span>News</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fal fa-newspaper"></i>
                            <span>News</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('posts.index') }}">View News</a>
                            <a class="dropdown-item" href="{{ route('posts-manage') }}">Manage News</a>
                            <a class="dropdown-item" href="{{ route('posts.create') }}">Create News</a>
                        </div>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('polls-manage') }}">
                            <i class="fal fa-poll"></i>
                            <span>Polls</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fal fa-poll"></i>
                            <span>Polls</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                           <a class="dropdown-item" href="{{ route('polls.index') }}">Vote</a>
                            <a class="dropdown-item" href="{{ route('polls-manage') }}">Manage Polls</a>
                           <a class="dropdown-item" href="{{ route('polls.create') }}">Create Poll</a>
                        </div>
                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fal fa-spa"></i>
                            <span>Massage</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                           <a class="dropdown-item" href="{{ route('massage') }}">Manage Payment</a>
                            <a class="dropdown-item" href="{{ route('massage-view') }}">Manage Massages</a>
                            {{--<a class="dropdown-item" href="{{ route('massage.create') }}">Create Massage List</a>--}}
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signups.index') }}">
                            <i class="fal fa-user-plus"></i>
                            <span>Sign-Ups</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fal fa-user-plus"></i>
                            <span>Sign Up for Еvent</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                           <a class="dropdown-item" href="{{ route('signup.index') }}">View Sign Up</a>
                            <a class="dropdown-item" href="{{ route('signup-manage') }}">Manage Sign Up</a>
                           <a class="dropdown-item" href="{{ route('signup-title.create') }}">Create Sign Up</a>
                        </div>
                    </li> --}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tags.index') }}">
                            <i class="fal fa-tags"></i>
                            <span>Tags</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            <i class="fal fa-folders"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manage-users') }}">
                            <i class="fal fa-users-cog"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            <i class="fal fa-spa"></i>
                            <span>Groups</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('groups.index') }}">Manage Groups</a>
                            <a class="dropdown-item" href="{{ route('groups-manage-users') }}">Manage User Groups</a>
                            {{--<a class="dropdown-item" href="{{ route('massage.create') }}">Create Massage List</a>--}}
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subscribe') }}">
                            <i class="fal fa-user-circle"></i>
                            <span>Subscribers</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('clear-cache-all') }}">
                            <i class="fal fa-broom"></i>
                            <span>Clear all cache</span>
                        </a>
                    </li>
                @endcan

                @cannot('manage-users')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">
                            <i class="fal fa-newspaper"></i>
                            <span>News</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('polls.index') }}">
                            <i class="fal fa-poll"></i>
                            <span>Polls</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('massage') }}">
                            <i class="fal fa-spa"></i>
                            <span>Massage Sign-Up</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signup.index') }}">
                            <i class="fal fa-user-plus"></i>
                            <span>Еvent Sign-Up</span>
                        </a>
                    </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact-us') }}">
                                <i class="fal fa-user-plus"></i>
                                <span>Contact Us</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#">
                                <i class="fal fa-user-circle"></i>
                                <span>Profile</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('user/profile') }}">
                                    Profile Settings
                                </a>
                            </div>
                        </li>
                @endcannot
            </ul>
        </div>
    </nav>
</div>
