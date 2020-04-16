@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/edit_post.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/textarea.js') }}" defer></script>
@endpush


@section('main-content')

<form class="row m-2 m-lg-0" action="../pages/post.php">
    <section id="categories-tab" class="col-12 col-lg-4">
        <header>Post Categories</header>
        <div class="input-group">
            <select class="custom-select">
                <option selected>Add new category...</option>
                {{-- TODO: get all categories to display here in the bellow format --}}
                {{-- <option value="1">College</option> --}}
            </select>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Add</button>
            </div>
        </div>
        <footer id="selected-categories" class="d-flex flex-row flex-wrap">
            {{--TODO: @each('partials.category_move_badge', $categories, 'category') --}}
        </footer>
    </section>

    <section id="text-tab" class="col-12 col-lg-7 ml-0 ml-lg-3 mt-4 mt-lg-0">
        <div class="d-flex flex-column justify-content-start align-items-stretch form-group">
            <input type="text" name="title" id="post-title" placeholder="Title" />
            <textarea id="post-body" name="body" placeholder="What is this post about?"></textarea>
            <div id="post-buttons" class="d-flex flex-row justify-content-end">
                <button class="btn btn-secondary">Cancel</button>
                <button class="btn btn-primary" type="submit">Post</button>
            </div>
        </div>
    </section>
</form>

@endsection