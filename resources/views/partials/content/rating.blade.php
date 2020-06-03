@auth
@php 
    $rating = App\Models\Rating::where('user_id', Auth::user()->id)->where('content', $content->id)->first();
    $rating = ($rating == null) ? '' : $rating->rating;
    $auth = true;
    @endphp
@endauth
@guest
@php
    $rating = '';
    $auth = false;
@endphp
@endguest
<div class="upvotes mr-3 @if($rating == 'upvote') selected @endif" data-id="{{ $content->id }}" data-auth="{{ $auth }}"><img src="{{ asset('images/hoof_filled.svg') }}" width="13" alt="uphoof" /> +<span>{{ $content->upvotes }}</span></div>
<div class="downvotes mr-3 @if($rating == 'downvote') selected @endif" data-id="{{ $content->id }}" data-auth="{{ $auth }}"><img src="{{ asset('images/hoof_outline.svg') }}" width="13" alt="downhoof" /> -<span>{{ $content->downvotes }}</span></div>