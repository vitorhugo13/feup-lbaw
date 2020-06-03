@auth
    {{-- if there will be no options then not even the dropdown icon shows up --}}
    @if ((Auth::user()->id != $user->id && Auth::user()->role != 'Blocked') || Auth::user()->id == $user->id)
        <div class="dropdown">
            <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
            <div class="dropdown-menu dropdown-menu-right">
                @if (Auth::user()->id != $user->id && Auth::user()->role != 'Blocked')
                    @switch($user->role) {{-- this refers to the owner of the profile page --}}
                        @case('Member')
                            @if (Auth::user()->role == 'Administrator')
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#promote-modal">Promote</a>
                            @endif
                            @break
                        @case('Moderator')
                            @if (Auth::user()->role == 'Administrator')
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#demote-modal">Demote</a>
                            @endif
                            @break
                    @endswitch
                @elseif (Auth::user()->id == $user->id)
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete-modal">Delete</a>
                @endif
            </div>
        </div>
    @endif
@endauth