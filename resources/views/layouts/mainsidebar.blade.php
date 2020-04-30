@extends('layouts.main')


@push('styles')
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/sidebar.js') }}" defer></script>
@endpush


@section('main-content')
    <div class="wraper">

        @yield('side-bar')
        @yield('content-body')
                
        <div class="overlay"></div>
    </div>
@endsection
