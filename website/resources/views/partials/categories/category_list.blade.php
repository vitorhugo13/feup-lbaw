<li style="cursor:pointer;">
    <form method="POST" action="{{ url('search/0') }}"> 
        @csrf
        <input type="hidden" value="1" name="category"/>
        <input type="hidden" value="{{ $category->title }}" name="search"/>
        <button class="badge badge-pill category-name" type="submit" aria-label="Category name search">! {{ $category->title }}</button>
    </form>
<li>