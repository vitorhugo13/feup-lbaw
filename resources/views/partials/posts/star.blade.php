@auth
@php $author = $post->content->owner; @endphp
@if ($author == null || Auth::user()->id != $author->id)
@php 
    $starred = Auth::user()->starredPosts->where('id', $post->id)->first();
@endphp
    <i class="{{ $starred == null ? 'far' : 'fas' }} fa-star" data-id="{{ $post->id }}"></i>
@endif
@endauth