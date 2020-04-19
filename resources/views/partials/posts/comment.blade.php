<div class="comment p-3" data-comment-id="{{ $comment->id }}">
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

        @auth
        <div class="d-flex flex-row">
            @include('partials.comment.options', ['author' => $comment->content->owner, 'comment' => $comment])
        </div>
        @endauth
    </header>
    <div class="comment-body">
        <p>{{ $comment->content->body }}</p>
    </div>
    <footer class="d-flex flex-row align-items-center justify-content-between">
        <div class="votes d-flex flex-row align-items-center justify-content-between">
            @include('partials.content.rating', ['content' => $comment->content])
        </div>
        <button class="reply-btn d-flex align-items-center" data-id="{{ $thread_id }}"><span>Reply</span></button>
    </footer>
</div>