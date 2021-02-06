@extends('layouts.main')
{{-- TODO: the layout to be used must have the header and footer --}}

@push('styles')
    <link href="{{ asset('css/error_pages.css') }}" rel="stylesheet">
@endpush


@section('main-content')
{{-- TODO: change the redirect to the homepage --}}
<div class="error text-center">
    <img src="{{ asset('images/suspicious_llama.svg') }}" width="170px" class="lama-img mt-2" alt="Lama photo">
    <h3 class="error-404">403 Access denied!</h3>
    <p class="error-404-p">You don't have permission to open this page...</p>
    {{-- <a href="{{ route('home') }}"><button type="submit" class="btn"><i class="fas fa-undo-alt"></i>   Return</button></a> --}}
</div>

@endsection
