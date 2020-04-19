<div class="dropdown">
    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
    <div class="dropdown-menu dropdown-menu-right">
        @switch(Auth::user()->role)
            @case('Blocked')
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item delete-comment-btn" data-toggle="modal" data-target="#delete-modal" data-comment-id="{{ $comment->id }}">Delete</a>
                    <a class="dropdown-item" href="#">Mute</a>
                @else
                    <a class="dropdown-item" href="#">Block User</a>
                @endif
                @break
            @case('Member')
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item edit-comment-btn" data-thread-id="{{ $thread_id }}" data-comment-id="{{ $comment->id }}">Edit</a>
                    <a class="dropdown-item" href="#">Mute</a>
                    <a class="dropdown-item delete-comment-btn" data-toggle="modal" data-target="#delete-modal" data-comment-id="{{ $comment->id }}">Delete</a>
                @else
                    <a class="dropdown-item" data-toggle="modal" data-target="#report-modal">Report</a>
                @endif
                @break
            @default
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item edit-comment-btn" data-thread-id="{{ $thread_id }}" data-comment-id="{{ $comment->id }}">Edit</a>
                    <a class="dropdown-item" href="#">Mute</a>
                    <a class="dropdown-item delete-comment-btn" data-toggle="modal" data-target="#delete-modal" data-comment-id="{{ $comment->id }}">Delete</a>
                @else
                    <a class="dropdown-item delete-comment-btn" data-toggle="modal" data-target="#delete-modal" data-comment-id="{{ $comment->id }}">Delete</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#report-modal">Report</a>
                    <a class="dropdown-item" href="#">Resolve</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#move-modal">Move</a>
                    <a class="dropdown-item" href="#">Block User</a>
                @endif
        @endswitch
    </div>
</div>