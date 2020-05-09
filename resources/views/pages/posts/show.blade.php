@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/textarea.js') }}" defer></script>
    <script src="{{ asset('js/edit_post.js') }}" defer></script>
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
    <script src="{{ asset('js/api/star.js') }}" defer></script>
    <script src="{{ asset('js/api/comment.js') }}" defer></script>
    <script src="{{ asset('js/api/post_move.js') }}" defer></script>
@endpush

@section('main-content')
<div class="post">
    <header class="d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
            <div class="post-user d-flex flex-row align-items-center justify-content-between">
                {{-- TODO: this photo path is temporary --}}
                @if ($author != null)
                    <a href="{{ route('profile', $author->id) }}"><img class="rounded-circle" src="{{ asset($author->photo) }}" width="40"></a>
                @else
                    <a><img class="rounded-circle" src="{{ asset('storage/uploads/avatars/default.png') }}" width="40"></a>
                @endif
                <div class="name-time">
                    @if ($author != null)
                        <a href="{{ route('profile', $author->id) }}">{{ $author->username }}</a>
                    @else
                        <a>anon</a>
                    @endif
                    &middot; @include('partials.content.time', ['creation_time' => $post->content->creation_time])
                </div>
            </div>
            @auth
            <div class="d-flex flex-row align-items-center">
                @include('partials.posts.star', ['post' => $post])
                @include('partials.posts.options', ['author' => $author, 'post' => $post])
            </div>
            @endauth
        </div>
        <h4>{{ $post->title }}</h4>
        <div class="post-categories">
            @each('partials.categories.normal_badge', $post->categories, 'category')
        </div>
    </header>
    <p class="post-body">{{ $post->content->body }}</p>
    <footer class="d-flex flex-row align-items-center">
        @include('partials.content.rating', ['content' => $post->content])
    </footer>
</div>

<div id="comment-section">
    <header>
        <span>Comments</span>
        <span> &middot; </span>
        <span id="num-comments">{{ $post->num_comments }}</span>
    </header>
    @include('partials.posts.comment_area', ['id' => $post->id])
    <div id="comments">
        @foreach($post->threads as $thread)
            @include('partials.posts.thread', ['thread' => $thread, 'author' => $author])
        @endforeach
    </div>
</div>

@include('partials.content.report_modal')
@include('partials.posts.move_modal', ['post_categories' => $post->categories, 'id' => $post->id, 'author' => $author])
@include('partials.comment.delete_modal')

@endsection
