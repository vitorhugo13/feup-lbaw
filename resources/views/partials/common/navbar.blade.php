<header>
    <nav class="navbar">
    <a class="navbar-brand" href="{{url('home')}}"><img src="{{asset('images/logo_text.svg')}}" width="50" alt="LAMA logo" /></a>
        <form class="expandable-search" action="{{url('search')}}">
            <input type="search" placeholder="Search" aria-label="Search" />
        </form>
        <div class="d-flex align-items-center">
            
            @auth
            <div class="dropdown d-flex align-items-center">
                {{-- TODO: user notifications --}}
                <span class="badge badge-pill badge-light mr-2">3</span>
                <i class="fas fa-bell" data-toggle="dropdown"></i>
                <div class="dropdown-menu dropdown-menu-right notification-menu"></div>
            </div>
            <div class="dropdown" style="margin-left: 1em">
                {{-- FIXME: the image path is temporary --}}
                <img class="rounded-circle dropdown-toggle" data-toggle="dropdown" src="{{ asset('images/' . Auth::user()->photo) }}" height="30">
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- TODO: add all of these links --}}
                    <a class="dropdown-item" href="">Profile</a>
                    <a class="dropdown-item" href="">Feed</a>
                    <a class="dropdown-item" href="">Reports</a>
                    <a class="dropdown-item" href=""><i class="fas fa-ban"></i> 49:30:06</a>
                    <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                </div>
            </div>            
            @endauth
            
            @guest
            <div id="log-buttons">
                <a href="{{ route('login') }}" class="btn">Log In</a>
                <a href="{{ route('register') }}" class="btn">Sign Up</a>
            </div>
            @endguest

        </div>
    </nav>
</header>
{{-- TODO: change the search url --}}
<form action="{{url('search')}}" id="collapsed-search" class="d-flex flex-row justify-content-center">
    <input type="search" placeholder="Search" aria-label="Search" />
</form>