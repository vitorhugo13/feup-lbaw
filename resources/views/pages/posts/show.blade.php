@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/comment.js') }}" defer></script>
    <script src="{{ asset('js/textarea.js') }}" defer></script>
    <script src="{{ asset('js/api/star.js') }}" defer></script>
@endpush


@section('main-content')


<div class="post">
    <header class="d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
            <div class="post-user d-flex flex-row align-items-center justify-content-between">
                <a href="{{ $link }}"><img class="rounded-circle" src="{{ $photo }}" width="40"></a>
                <div class="name-time">
                    {{-- TODO: missing link to user profile --}}
                    <a href="{{ $link }}">{{ $username }}</a>
                    @include('partials.content.time', ['creation_time' => $post->content->creation_time])
                </div>  
            </div>
            <div class="d-flex flex-row align-items-center">
                {{-- TODO: check if the current user has the post starred or not --}}
                @if ($starred)
                    <i class="fas fa-star mr-3" data-id="{{ $post->id }}"></i>
                @else
                    <i class="far fa-star mr-3" data-id="{{ $post->id }}"></i>
                @endif

                <div class="dropdown d-flex align-items-center">
                    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        {{-- TODO: these options will not all be presented to all users --}}
                        <a class="dropdown-item" data-toggle="modal" data-target="#report-modal">Report</a>
                        <a class="dropdown-item" href={{ route('edit', $post->id) }}>Edit</a>
                        <a class="dropdown-item" href="#">Mute</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#move-modal">Move</a>
                        <a class="dropdown-item" href="#">Block User</a>
                        <a class="dropdown-item" href="#">Resolve</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <h4>{{ $post->title }}</h4>
        <div class="post-categories">
            @each('partials.categories.normal_badge', $post->categories, 'category')
        </div>
    </header>
    {{-- TODO: make a partial to separate the content body into paragraphs --}}
    <div class="post-body">{{ $post->content->body }}</div>
    <footer class="d-flex flex-row align-items-center">
        {{-- TODO: check if the user has rated the post --}}
        <div class="upvotes"><img src="{{ asset('images/hoof_filled.svg') }}" width="13" alt="uphoof" /> +{{ $post->content->upvotes }}</div>
        <div class="downvotes"><img src="{{ asset('images/hoof_outline.svg') }}" width="13" alt="downhoof" /> -{{ $post->content->downvotes }}</div>
    </footer>
</div>

<div id="comment-section">
    {{-- TODO: get the number of comments --}}
<header><span>Comments</span><span> &middot; </span><span>{{ $post->num_comments }}</span></header>
    @include('partials.posts.comment_area')
    <div id="comments">
        @each('partials.posts.thread', $post->threads, 'thread')
    </div>
</div>

{{-- TODO: draw move moval --}}
@include('partials.content.report_modal')

@endsection
