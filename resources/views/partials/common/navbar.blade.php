<header>
    <nav class="navbar">
    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{asset('images/logo_text.svg')}}" width="50" alt="LAMA logo" /></a>
        {{-- TODO: change the action --}}
        <form method="POST" class="expandable-search" action="{{ url('search/0') }}"> 
            @csrf
            <input type="search" placeholder="Search" aria-label="Search" name="search"/>
        </form>

        <div class="d-flex align-items-center">
                        
            @auth
            <div class="dropdown" style="margin-left: 1em">
                <img class="rounded-circle dropdown-toggle" data-toggle="dropdown" src="{{ asset(Auth::user()->photo) }}" alt="Profile picture dropdown" height="30">
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ url('../users', Auth::user()->id) }}">Profile</a>
                    <a class="dropdown-item" href="{{ route('feed') }}">Feed</a>
                    @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Moderator')                        
                        <a class="dropdown-item" href="{{ route('reports') }}">Reports</a>
                    @endif
                    @php
                        $currentDate = date("Y-m-d");
                        $currentTime = date("H:i:s");
                        $currentDate = date("Y-m-d H:i:s", strtotime($currentDate . $currentTime));
                        $remaining = strtotime(Auth::user()->release_date) - strtotime($currentDate);
                    @endphp
                    @if (Auth::user()->role == 'Blocked' && $remaining - 3600 > 0)
                        @php
                            $hours = floor($remaining / 3600) - 1;
                            $minutes = floor(($remaining / 60) % 60);
                            $seconds = $remaining % 60;
                        @endphp

                        <a class="dropdown-item remainingTime" href="{{ url('../users/' . Auth::user()->id . "#blocked") }}">
                            <i class="fas fa-ban"></i> 
                            <span class="hiddentime" hidden>{{Auth::user()->release_date}}</span>
                            <span class="remain-hour"><?=(($hours < 10) ? '0' : '')?>{{$hours}}</span><span>:</span><span class="remain-minute"><?=(($minutes < 10) ? '0' : '')?>{{$minutes}}</span><span>:</span><span class="remain-second"><?=(($seconds < 10) ? '0' : '')?>{{$seconds}}</span>
                        </a>

                    @endif
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
<form method="POST" action="{{ url('search/0') }}" id="collapsed-search" class="d-flex flex-row justify-content-center">
    @csrf
    <input type="search" placeholder="Search" aria-label="Search" id="search"/>
</form>