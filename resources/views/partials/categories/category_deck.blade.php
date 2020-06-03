<div class="category-cards card-deck row row-cols-1 row-cols-md-2">
    @each('partials.categories.category_card', collect($categories)->filter(function ($value) {return $value->title != 'Community News';}), 'category')
</div>