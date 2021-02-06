@if(!$posts->isEmpty())
    @each('partials.posts.preview',  collect($posts), 'post')
@else
    <h4 class="no-results"> No content.. &#9785; </h4>
@endif

<input type="hidden" value="{{ $posts }}">
