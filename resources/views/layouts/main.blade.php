@extends('layouts.headerless')

@push('scripts')
    <script src="{{asset('js/searchbar.js')}}" defer></script>
@endpush

@push('styles')
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
@endpush

@section('content')

@include('partials.common.navbar')

<div id="content">
    @yield('main-content')
</div>

<footer id="footer">
    <div id="footer-content" class="d-flex justify-content-between">
        <ul>
            <li>Contacts:</li>
            <li>lama@gmail.com</li>
            <li>+420 01 01 01 01</li>
            <li>Areosa, Porto</li>
        </ul>
        <ul>
            <li>About:</li>
        <li><a href="{{ route('team') }}">Team</a></li>
            <li><a href="{{ route('regulations') }}">Regulations</a></li>
        </ul>
    </div>
</footer>

@endsection

