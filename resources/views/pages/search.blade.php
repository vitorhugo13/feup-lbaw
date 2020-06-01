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
                        <input class="form-check-input" type="checkbox" value="" id="filter-username">
                        Username
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="filter-category">
                        <input class="form-check-input" type="checkbox" value="" id="filter-category">
                        Category
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="filter-title">
                        <input class="form-check-input" type="checkbox" value="" id="filter-title">
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
    <nav class="filters d-lg-none mb-3 d-flex flex-column align-items-center">
        <div class="nav nav-pills" id="mid-pills-tab" role="tablist">
            <a class="nav-item nav-link fresh-tab active" data-toggle="tab" href="#nav-fresh" aria-selected="true">Fresh</a>
            <a class="nav-item nav-link hot-tab" data-toggle="tab" href="#nav-hot" aria-selected="false">Hot</a>
            <a class="nav-item nav-link top-tab" data-toggle="tab" href="#nav-top" aria-selected="false">Top</a>
        </div>
    </nav>
    {{-- <h1>Search Results</h1>  TODO: Ver como isto vai funcionar...--}}
    <div id="search-results">
        @if(!$posts->isEmpty())
            @include('partials.posts.post_deck', ['posts' => $posts])
        @else
            <h4 class="no-results"> No results.. &#9785; </h4>
        @endif
    </div>
@endsection