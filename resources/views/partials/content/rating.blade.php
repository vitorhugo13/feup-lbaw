@push('scripts')
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
@endpush

@auth
@php 
    $rating = App\Models\Rating::where('user_id', Auth::user()->id)->where('content', $content->id)->first();
    $rating = ($rating == null) ? '' : $rating->rating;
@endphp
@endauth
@guest
@php
    $rating = '';
@endphp
@endguest
<div class="upvotes mr-3 @if($rating == 'upvote') selected @endif" data-id="{{ $content->id }}"><img src="{{ asset('images/hoof_filled.svg') }}" width="13" alt="uphoof" /> +<span>{{ $content->upvotes }}</span></div>
<div class="downvotes mr-3 @if($rating == 'downvote') selected @endif" data-id="{{ $content->id }}"><img src="{{ asset('images/hoof_outline.svg') }}" width="13" alt="downhoof" /> -<span>{{ $content->downvotes }}</span></div>