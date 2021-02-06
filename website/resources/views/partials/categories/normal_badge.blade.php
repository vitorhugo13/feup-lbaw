{{-- TODO: missing the link to the category --}}
{{-- TODO: change link on post_move.js as well--}}
{{-- <a href="#" class="badge badge-pill category-badge">! {{ $category->title }}</a> --}}
<form method="POST" class="category-form" action="{{ url('search/0') }}"> 
    @csrf
    <input type="hidden" value="1" name="category"/>
    <input type="hidden" value="{{ $category->title }}" name="search"/>
    <button class="badge badge-pill category-badge" type="submit" aria-label="Category name search">! {{ $category->title }}</button>
</form>