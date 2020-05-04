@extends('layouts.mainsidebar')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/categories.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/category_star.js') }}" defer></script>
@endpush

@section('main-content')
<section id="wrapper">
    <aside id="sidebar" class="d-flex flex-column align-items-center">
        <div id="sidebar-navigation" class="d-flex flex-column align-items-center">
            <p class="align-self-start ml-3">Order By:</p>
            <ul class="nav flex-column nav-pills text-center">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#">Name</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#">Activity</a>
                </li>
            </ul>
        </div>
        <a href={{ route('create') }}><i class="fas fa-plus"></i><strong> New Post</strong></a>
        @if(Auth::check() && Auth::user()->role == 'Administrator')
            <a data-toggle="modal" data-target="#new_category_modal" style="cursor: pointer;"><i class="fas fa-plus"></i><strong> New Category</strong></a>
        @endif
        <div id="side-toggle">
            <i class="fas fa-bars active" id="angle-right"></i>
            <i class="fas fa-bars" id="angle-left"></i>
        </div>
    </aside>
    <!-- Dark Overlay element -->
    <div class="overlay"></div>

    <main id="feed">
        <section class="card-deck row">
            <div class="col-0 col-md-3"></div>
            @include('partials.categories.category_card', ['category' => $categories->where('title', 'Community News')->first()])
            <div class="col-0 col-md-3"></div>
        </section>

        <section class="card-deck row row-cols-1 row-cols-md-2">
            @each('partials.categories.category_card', collect($categories)->filter(function ($value) {return $value->title != 'Community News';}), 'category')
        </section>

    </main>

    @include('partials.categories.new_category_modal')

</section>
@endsection
