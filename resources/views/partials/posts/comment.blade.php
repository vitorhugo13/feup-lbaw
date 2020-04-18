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

        @auth
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
        @endauth
    </header>
    <div class="comment-body">
        <p>{{ $comment->content->body }}</p>
    </div>
    <footer class="d-flex flex-row align-items-center justify-content-between">
        <div class="votes d-flex flex-row align-items-center justify-content-between">
            @auth
            @php 
                $rating = App\Models\Rating::where('user_id', Auth::user()->id)->where('content', $comment->id)->first();
                $rating = ($rating == null) ? '' : $rating->rating;
            @endphp
            @endauth
            @guest
            @php
                $rating = '';
            @endphp
            @endguest
            <div class="upvotes mr-3 @if($rating == 'upvote') selected @endif" data-id="{{ $comment->id }}"><img src="{{ asset('images/hoof_filled.svg') }}" width="11" alt="downhoof"/></i>+<span>{{ $comment->content->upvotes }}</span></div>
            <div class="downvotes mr-3 @if($rating == 'downvote') selected @endif" data-id="{{ $comment->id }}"><img src="{{ asset('images/hoof_outline.svg') }}" width="11" alt="downhoof"/></i>-<span>{{ $comment->content->downvotes }}</span></div>
        </div>
        <button class="reply-btn d-flex align-items-center" data-id="{{ $thread_id }}"><span>Reply</span></button>
    </footer>
</div>