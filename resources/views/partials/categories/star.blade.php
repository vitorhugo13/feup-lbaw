@if (Auth::user()->id != null)
@php 
    $starred = Auth::user()->starredCategories->where('id', $category->id)->first();
@endphp
    <i class="{{ $starred == null ? 'far' : 'fas' }} fa-star" data-id="{{ $category->id }}"></i>
@endif