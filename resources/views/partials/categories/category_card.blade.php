<div class="col mb-4 px-3 px-sm-0">
        <article class="card category-card">
            <div class="card-body">
                <header class="d-flex flex-row justify-content-between">
                    <h5 class="card-title">! {{ $category->title }}</h5>
                    <aside>
                        @if(Auth::check() && Auth::user()->role == 'Administrator')
                            <i class="fas fa-pen"></i>
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
