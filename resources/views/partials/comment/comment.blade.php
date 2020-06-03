<div class="comment p-3" data-comment-id="{{ $comment->id }}">
    <header class="d-flex flex-row align-items-center justify-content-between">
        <div class="name-time">
            {{-- TODO: missing link to user profile --}}
            @if ($comment->content->owner == null)
                <span>anon</span>
            @else
                <a href="{{ $comment->content->owner->id }}"
                @if ($author != null && $comment->content->owner->id == $author->id)
                    class="op"
                @endif>{{ $comment->content->owner->username }}</a>
            @endif

            &middot; @include('partials.content.time', ['creation_time' => $comment->content->creation_time])
        </div>

        @auth
        <div class="d-flex flex-row">
            @include('partials.comment.options', ['author' => $comment->content->owner, 'comment' => $comment])
        </div>
        @endauth
    </header>
    <p class="comment-body">{{ $comment->content->body }}</p>
    <footer class="d-flex flex-row align-items-center justify-content-between">
        <div class="votes d-flex flex-row align-items-center justify-content-between">
            @include('partials.content.rating', ['content' => $comment->content])
        </div>
        <button class="reply-btn d-flex align-items-center" data-id="{{ $thread_id }}" data-comment-id="{{ $comment->id }}"><span>Reply</span></button>
    </footer>
</div>