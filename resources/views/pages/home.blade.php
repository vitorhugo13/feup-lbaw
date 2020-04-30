@extends('layouts.mainsidebar')

@push('styles')
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/filters.js') }}" defer></script>
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
    <script src="{{ asset('js/api/star.js') }}" defer></script>
@endpush

@section('side-bar')
    <div id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <div>
                <nav>
                    <div class="nav nav-pills" id="pills-tab" role="tablist">
                        <a class="nav-item nav-link fresh-tab active" data-toggle="tab" href="#nav-fresh" aria-selected="true">Fresh</a>
                        <a class="nav-item nav-link hot-tab" data-toggle="tab" href="#nav-hot" aria-selected="false">Hot</a>
                        <a class="nav-item nav-link top-tab" data-toggle="tab" href="#nav-top" aria-selected="false">Top</a>
                    </div>
                </nav>
                <div class="tab-categories tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-fresh" role="tabpanel" aria-labelledby="nav-fresh-tab">
                        <ul>
                            <li>! Politics</li>
                            <li>! Cars</li>
                            <li>! College</li>
                            <li>! Religion</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-hot" role="tabpanel" aria-labelledby="nav-hot-tab">
                        <ul>
                            <li>! Feelings</li>
                            <li>! Cars</li>
                            <li>! Religion</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-top" role="tabpanel" aria-labelledby="nav-top-tab">
                        <ul>
                            <li>! College</li>
                            <li>! Teenager</li>
                            <li>! Politics</li>
                            <li>! Cars</li>
                            <li>! Corona Virus</li>
                        </ul>
                    </div>
                </div>
            </div>
            <a id="view-categories" href="#">View all</a>
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

    <div id="feed">
    </div>
@endsection
