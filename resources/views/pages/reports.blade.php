@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reports.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/reports/reports.js') }}" defer></script>
    <script src="{{ asset('js/api/reports/ignore.js') }}" defer></script>
@endpush

@section('main-content')
<h1>Reports Table</h1>
<section class="wrapper">
    
    <!-- Dark Overlay element -->
    <div class="overlay"></div>

    <nav id="sidebar-navigation" class="d-flex flex-column align-items-center">
        <div class="nav nav-pills" id="mid-pills-tab" role="tablist">
            <a class="nav-item nav-link active" id="posts-nav" data-toggle="tab" href="#posts-tab" role="tab" aria-selected="true">Posts</a>
            <a class="nav-item nav-link" id="comments-nav" data-toggle="tab" href="#comments-tab" role="tab" aria-selected="false">Comments</a>
            <a class="nav-item nav-link" id="contests-nav" data-toggle="tab" href="#contests-tab" role="tab" aria-selected="false">Contests</a>
        </div>
    </nav>

    <div id="main">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="posts-tab" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="posts-table">
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="comments-tab" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="comments-table">
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="contests-tab" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Justification</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="contests-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- @include('partials.posts.move_modal', ['post_categories' => $post->categories]) --}}
@endsection
