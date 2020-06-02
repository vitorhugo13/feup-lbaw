@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/error_pages.css') }}" rel="stylesheet">
    <link href="{{ asset('css/feed.css') }}" rel="stylesheet">
@endpush

@section('main-content')

<div class="error text-center">
    <img src="{{ asset('images/happy_llama.svg') }}" width="170px" class="lama-img mt-2" alt="Lama photo">
    <h3>Looks like you're a shy Lama</h3>
    <p class="empty-p">Your feed is empty because you have no starred posts or categories.</p>
    <p class="empty-p">Get out there and start poking stuff!</p>
</div>

@endsection