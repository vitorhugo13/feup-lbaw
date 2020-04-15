@extends('layouts.main')

@section('main-content')
    <div class="wraper">
        <div class="overlay">

            @yield('side-bar')
            @yield('content-body')
                
        </div>
    </div>
@endsection
