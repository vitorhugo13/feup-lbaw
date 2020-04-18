@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/comment.js') }}" defer></script>
    <script src="{{ asset('js/textarea.js') }}" defer></script>
    <script src="{{ asset('js/api/star.js') }}" defer></script>
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
    <script src="{{ asset('js/api/comment.js') }}" defer></script>
@endpush


@section('main-content')


<div class="post">
    <header class="d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
            <div class="post-user d-flex flex-row align-items-center justify-content-between">
                {{-- TODO: this photo path is temporary --}}
                {{-- FIXME: for some reason route('profile' , $author->id) was not working --}}
                @if ($author != null)
                    <a href="{{ url('users/' . $author->id) }}"><img class="rounded-circle" src="{{ asset('images/' . $author->photo) }}" width="40"></a>
                @else
                    <a><img class="rounded-circle" src="{{ asset('images/default_picture.png') }}" width="40"></a>
                @endif
                <div class="name-time">
                    @if ($author != null)
                        <a href="{{ url('users/' . $author->id) }}">{{ $author->username }}</a>
                    @else
                        <a>anon</a>
                    @endif
                    @include('partials.content.time', ['creation_time' => $post->content->creation_time])
                </div>  
            </div>
            @auth
            <div class="d-flex flex-row align-items-center">
                @if ($author == null || Auth::user()->id != $author->id)
                    @if ($starred)
                        <i class="fas fa-star" data-id="{{ $post->id }}"></i>
                    @else
                        <i class="far fa-star" data-id="{{ $post->id }}"></i>
                    @endif
                @endif
                @include('partials.posts.options', ['author' => $author])
            </div>
            @endauth
        </div>
        <h4>{{ $post->title }}</h4>
        <div class="post-categories">
            @each('partials.categories.normal_badge', $post->categories, 'category')
        </div>
    </header>
    {{-- TODO: make a partial to separate the content body into paragraphs --}}
    <div class="post-body">{{ $post->content->body }}</div>
    <footer class="d-flex flex-row align-items-center">
        @include('partials.content.rating', ['content' => $post->content])
    </footer>
</div>

<div id="comment-section">
<header><span>Comments</span><span> &middot; </span><span>{{ $post->num_comments }}</span></header>
    @include('partials.posts.comment_area', ['id' => $post->id])
    <div id="comments">
        @each('partials.posts.thread', $post->threads, 'thread')
    </div>
</div>

{{-- TODO: draw move moval --}}
@include('partials.content.report_modal')
{{-- @include('partials.posts.move_modal') --}}

@endsection
