@extends('layouts.mainsidebar')

@push('styles')
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
    <script src="{{ asset('js/api/star.js') }}" defer></script>
    <script src="{{ asset('js/search.js') }}" defer></script>
@endpush

@section('page-title')
    <p class="search-tooltip"> <strong>Search results for:</strong> "{{ str_replace(' | ', ' ', $original_search) }}" </p>
@endsection

@section('side-bar')
    <div id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-start">
            <nav>
                <div class="filter-title">
                    Filters:
                </div>
            </nav>
            <div class="d-flex flex-column align-self-start" id="filters">
                <input type="hidden" value="{{ $search }}" id="search-query">
                <div class="form-check">
                    <label class="form-check-label" for="filter-username">
                        <input class="form-check-input" type="checkbox" autocomplete="off" value="" id="filter-username"
                        @if($flags[0])
                            checked
                        @endif>
                        Username
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="filter-category">
                        <input class="form-check-input" type="checkbox" autocomplete="off" value="" id="filter-category"
                        @if($flags[1])
                            checked
                        @endif>
                        Category
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="filter-title">
                        <input class="form-check-input" type="checkbox" autocomplete="off" value="" id="filter-title"
                        @if($flags[2])
                            checked
                        @endif>
                        Title
                    </label>
                </div>
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
    <div id="search-results">
        @if(!$posts->isEmpty())
            @include('partials.posts.post_deck', ['posts' => $posts])
        @else
            <h4 class="no-results"> No results.. &#9785; </h4>
        @endif
    </div>
@endsection