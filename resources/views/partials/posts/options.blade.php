<div class="dropdown d-flex align-items-center ml-3">
    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
    <div class="dropdown-menu dropdown-menu-right">
        @switch(Auth::user()->role)
            @case('Blocked')
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item">
                        <form method="POST" action="{{ route('delete', $post->id) }}" onclick='submit()'>
                        @csrf @method('DELETE')
                        Delete
                        </form>
                    </a>
                    <a class="dropdown-item" href="#">Mute</a>
                @endif
                @break
            @case('Member')
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item" href="{{ route('edit', $post->id) }}">Edit</a>
                    <a class="dropdown-item" href="#">Mute</a>
                    <a class="dropdown-item">
                        <form method="POST" action="{{ route('delete', $post->id) }}" onclick='submit()'>
                        @csrf @method('DELETE')
                        Delete
                        </form>
                    </a>
                @else
                    <a class="dropdown-item" data-toggle="modal" data-target="#report-modal"  data-content-id="{{$post->id}}">Report</a>
                @endif
                @break
            @default
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item" href="{{ route('edit', $post->id) }}">Edit</a>
                    <a class="dropdown-item" href="#">Mute</a>
                    <a class="dropdown-item">
                        <form method="POST" action="{{ route('delete', $post->id) }}" onclick='submit()'>
                        @csrf @method('DELETE')
                        Delete
                        </form>
                    </a>
                @else
                    <a class="dropdown-item">
                        <form method="POST" action="{{ route('delete', $post->id) }}" onclick='submit()'>
                        @csrf @method('DELETE')
                        Delete
                        </form>
                    </a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#report-modal"  data-content-id="{{$post->id}}">Report</a>
                    <a class="dropdown-item" href="#">Resolve</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#move-modal">Move</a>
                @endif
        @endswitch
    </div>
</div>