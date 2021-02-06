<div class="dropdown">
    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
    <div class="dropdown-menu dropdown-menu-right">
        @switch(Auth::user()->role)
            @case('Blocked')
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item delete-comment-btn" data-toggle="modal" data-target="#delete-modal" data-comment-id="{{ $comment->id }}">Delete</a>
                @endif
                @break
            @case('Member')
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item edit-comment-btn" data-thread-id="{{ $thread_id }}" data-comment-id="{{ $comment->id }}">Edit</a>
                    <a class="dropdown-item delete-comment-btn" data-toggle="modal" data-target="#delete-modal" data-comment-id="{{ $comment->id }}">Delete</a>
                @else
                    <a class="dropdown-item" data-toggle="modal" data-target="#report-modal"  data-content-id="{{$comment->id}}">Report</a>
                @endif
                @break
            @default
                @if ($author != null && Auth::user()->id == $author->id)
                    <a class="dropdown-item edit-comment-btn" data-thread-id="{{ $thread_id }}" data-comment-id="{{ $comment->id }}">Edit</a>
                    <a class="dropdown-item delete-comment-btn" data-toggle="modal" data-target="#delete-modal" data-comment-id="{{ $comment->id }}">Delete</a>
                @else
                    <a class="dropdown-item" data-toggle="modal" data-target="#report-modal" data-content-id="{{$comment->id}}">Report</a>
                @endif
        @endswitch
    </div>
</div>