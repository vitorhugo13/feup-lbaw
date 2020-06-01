<div class="col mb-4 px-3 px-sm-0">
        <article class="card category-card" data-category-id="{{ $category->id }}">
            <div class="card-body">
                <header class="d-flex flex-row justify-content-between">
                    <form method="POST" class="expandable-search" action="{{ url('search/0') }}"> 
                        @csrf
                        <input type="hidden" value="1" name="category"/>
                        <input type="hidden" value="{{ $category->title }}" name="search"/>
                        <button class="card-title" type="submit" aria-label="Category name search">! {{ $category->title }}</button>
                    </form>
                    {{-- <h5 class="card-title">! {{ $category->title }}</h5> --}}
                    <aside>
                        @if(Auth::check() && Auth::user()->role == 'Administrator' && $category->title != 'Community News')
                            <a data-toggle="modal" data-category-id="{{ $category->id }}" data-target="#edit-category-modal"><i class="fas fa-pen"></i></a>
                        @endif
                        @include('partials.categories.star', ['category' => $category])
                    </aside>
                </header>
            </div>
            <footer class="card-footer d-flex flex-row justify-content-between">
                <p>{{ $category->num_posts }} posts </p> <p>Last active: @include('partials.content.time', ['creation_time' => $category->last_activity])</p>
            </footer>
        </article>
</div>
