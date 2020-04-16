@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/comment.js') }}" defer></script>
    <script src="{{ asset('js/textarea.js') }}" defer></script>
@endpush


@section('main-content')


<div class="post">
    <header class="d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
            <div class="post-user d-flex flex-row align-items-center justify-content-between">
                <a href="#"><img class="rounded-circle" src="../assets/user.jpg" width="40"></a>
                <div class="name-time">
                    <a href="#">DanTheWhiskyMan</a>
                    <span>&middot; 17h ago</span>
                </div>
            </div>
            <div class="d-flex flex-row align-items-center">
                <i class="far fa-star mr-3"></i>
                <div class="dropdown d-flex align-items-center">
                    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-toggle="modal" data-target="#report-modal">Report</a>
                        <a class="dropdown-item" href="edit_post.php">Edit</a>
                        <a class="dropdown-item" href="#">Mute</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#move-modal">Move</a>
                        <a class="dropdown-item" href="#">Block User</a>
                        <a class="dropdown-item" href="#">Resolve</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <h4> {{ $post->title }}</h1>
            <div class="post-categories">
                {{-- @foreach($post->categories as $category)
                    <li>{{ $category->title }}</li>
                @endforeach --}}
                @each('partials.categories.normal_badge', $post->categories, 'category')
                {{-- TODO: draw badges
                 draw_category_badge('Politics'); ?>
                 draw_category_badge('Gaming'); ?>
                 draw_category_badge('Ethics'); ?> --}}
            </div>
    </header>
    {{-- TODO: make a partial to separate the content body into paragraphs --}}
    <div class="post-body">{{ $content->body }} </div>
    <footer class="d-flex flex-row align-items-center">
        <div class="upvotes"><img src="{{ asset('images/hoof_filled.svg') }}" width="13" alt="uphoof" /> +{{ $content->upvotes }}</div>
        <div class="downvotes"><img src="{{ asset('images/hoof_outline.svg') }}" width="13" alt="downhoof" /> -{{ $content->downvotes }}</div>
    </footer>
</div>
{{-- TODO: comment-section

    <div id="comment-section">
    <header><span>Comments</span><span> &middot; </span><span>1230</span></header>
    @include('partials.comment_area')
    <div id="comments">
        draw_thread(['AbhorrentCards', '15h ago', 'Does an Escalade pull of you off the plane everytime you land?', '104', '2', '1'], [['DanTheWhiskyMan', '14h ago', 'Yes I only accept Escalades or Continentals ;)', '10', '0']]); ?>
        draw_thread(['afihavok', '16h ago', 'Redditors: this is an AMA, please be wary of proof until...sees username...K, were good.', '261', '24', '2'], [['DanTheWhiskyMan', '14h ago', 'It was almost intentional ;)', '1', '2'], ['delinquent', '12h ago', 'I love self evident names.', '74', '12']]); ?>
    </div>
</div> --}}

{{-- TODO: draw move moval --}}
{{-- TODO: draw report modal --}}

@endsection
