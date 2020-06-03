@extends('layouts.main')
{{-- TODO: the layout to be used must have the header and footer --}}

@push('styles')
    <link href="{{ asset('css/error_pages.css') }}" rel="stylesheet">
@endpush

@section('main-content')

{{-- TODO: change the redirect to the homepage --}}
<div class="error text-center">
    <img src="{{ asset('images/surprised_llama.svg') }}" width="170px" class="lama-img mt-2" alt="Lama photo">
    <h3 class="error-500">500 Internal Server Error!</h3>
    <p class="error-500-p">Well, this is awkward... Don't worry, the admins have been notified!</p>
</div>

@endsection
