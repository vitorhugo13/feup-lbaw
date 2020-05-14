@extends('layouts.mainsidebar')

@push('styles')
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/feed.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
    <script src="{{ asset('js/api/star.js') }}" defer></script>
    <script src="{{ asset('js/api/filter_posts.js') }}" defer></script>
@endpush

@section('side-bar')
    <div id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <div class="align-items-left">
                <p class="nav-title">Starred Categories</p>
            </div>
            <div class="opt">
                @if($starred_categories != null)
                    @include('partials.categories.category_selection', ['categories' => $starred_categories])
                @endif
            </div>
        </div>
        <a href="{{ route('create') }}"><i class="fas fa-plus"></i><strong> New Post</strong></a>
        <div id="side-toggle">
            <i class="fas fa-bars active" id="angle-right"></i>
            <i class="fas fa-bars" id="angle-left"></i>
        </div>
    </div>
@endsection

@section('content-body')
    {{-- <h1>Personal Feed</h1>  TODO: Ver como isto vai funcionar...--}}
    <div id="feed">
        @include('partials.posts.post_deck', ['posts' => $posts])
    </div>
@endsection
