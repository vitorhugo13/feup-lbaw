<div class="comment p-3">
    <header class="d-flex flex-row align-items-center justify-content-between">
        <div class="name-time">
            {{-- TODO: missing link to user profile --}}
            @if ($comment->content->owner == null)
                <span>anon</span>
            @else
                <span>{{ $comment->content->owner->username }}</span>
            @endif

            @include('partials.content.time', ['creation_time' => $comment->content->creation_time])
        </div>
        <div class="d-flex flex-row">
            <div class="dropdown">
                <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" data-toggle="modal" data-target="#report-modal">Report</a>
                    <a class="dropdown-item" href="#">Edit</a>
                    <a class="dropdown-item" href="#">Mute</a>
                    <a class="dropdown-item" href="#">Block User</a>
                    <a class="dropdown-item" href="#">Resolve</a>
                    <a class="dropdown-item" href="#">Delete</a>
                </div>
            </div>
        </div>
    </header>
    <div class="comment-body">
        <p>{{ $comment->content->body }}</p>
    </div>
    <footer class="d-flex flex-row align-items-center justify-content-between">
        <div class="votes d-flex flex-row align-items-center justify-content-between">
            <div class="upvotes mr-3"><img src="{{ asset('images/hoof_filled.svg') }}" width="11" alt="downhoof"/></i>+{{ $comment->content->upvotes }}</div>
            <div class="downvotes mr-3"><img src="{{ asset('images/hoof_outline.svg') }}" width="11" alt="downhoof"/></i>-{{ $comment->content->downvotes }}</div>
        </div>
        <button class="reply-btn d-flex align-items-center"><span>Reply</span></button>
    </footer>
</div>