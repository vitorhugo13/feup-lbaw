@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/star.js') }}" defer></script>
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
    <script src="{{ asset('js/api/profile_permissions.js') }}" defer></script>
    <script src="{{ asset('js/api/block_user.js') }}" defer></script>
    <script src="{{ asset('js/counter.js') }}" defer></script>
    <script src="{{ asset('js/contest_block.js') }}" defer></script>
    <script src="{{ asset('js/api/block_information.js') }}" defer></script>
@endpush

@section('main-content')
<section class="row justify-content-center">
    <article class="user-info col-12 col-lg-5 d-flex flex-column justify-content-center align-items-center" data-user-id="{{ $user->id }}">
    <!--TODO: change directory -->
        <img src="{{ asset($user->photo) }}" class="img rounded-circle" alt="Profile photo">
        <div class="username d-flex flex-row align-items-center mt-3">
            <p>{{ $user-> username}}</p>
            @include('partials.profile.options', [ 'user' => $user ])
        </div>
        <p class="bio text-left">{{$user->bio}} </p>

        @if(Auth::check() && $user->id == Auth::user()->id)
            <a class="edit-button" href="{{url('users/' . $user->id . '/edit')}}"><strong>Edit profile</strong></a>
        @endif

        @if(Auth::check() && ($user->id == Auth::user()->id || Auth::user()->role == 'Administrator'))
            @php
                $currentDate = date("Y-m-d");
                $currentTime = date("H:i:s");
                $currentDate = date("Y-m-d H:i:s", strtotime($currentDate . $currentTime));
                $remaining = strtotime($user->release_date) - strtotime($currentDate);
            @endphp
            @if($remaining - 3600 > 0) 
                <div id="blocked" class="mt-5">

                    @if(Auth::check() && $user->id == Auth::user()->id )
                        <p class="blocked-text mb-1">You are blocked for:</p>
                    @else 
                        <p class="blocked-text mb-1">User blocked for: </p>
                    @endif

                    <p class="remaining-time">
                        @php
                            $hours = floor($remaining / 3600) - 1;
                            $minutes = floor(($remaining / 60) % 60);
                            $seconds = $remaining % 60;
                        @endphp

                        <span class="hidden-time" hidden>{{$user->release_date}}</span>
                        <span class="remain-hours"><?=(($hours < 10) ? '0' : '')?>{{$hours}}h </span>
                        <span class="remain-min"><?=(($minutes < 10) ? '0' : '')?>{{$minutes}}m </span>
                        <span class="remain-sec"><?=(($seconds < 10) ? '0' : '')?>{{$seconds}}s</span>
                    </p>

                    @if(Auth::check() && $user->id == Auth::user()->id )
                        <button class="contest-button" data-toggle="modal" data-target="#contest-modal"><i class="fas fa-exclamation-circle"></i><strong> Contest </strong></button>
                    @endif

                </div>
            @endif
        @endif
        
    </article>
    <article class="points-info col-12 col-lg-6 d-flex flex-column justify-content-around align-items-stretch ml-0 ml-lg-4 mt-4 mt-lg-0">
        <div class="glory-points d-flex flex-column justify-content-center align-self-center d-flex flex-column align-items-center">
        <img src="{{asset('images/gold_llama.svg')}}" alt="photo">
            <p class="user-points">&diams; <span class="number_points"> <?= $user->glory ?> </span>  <span><?=(($user->glory == 1) ? ' point' : ' points') ?> </span> &diams;</p>
        </div>

        @if(count($categories) > 0)
        <hr>
        <div class="top-categories">
            <h3>Top Categories</h3>
            @each('partials.profile.category', $categories, 'category')     
        </div>
        @endif

    </article>
</section>

<div class="post-section">
    {{-- FIXME: count only the visible posts --}}
    <p class="number-posts ml-1 mb-2"> <strong>Posts</strong> ({{count($user->posts)}})</p>
    @each('partials.posts.preview', $user->posts, 'post')
</div>


@include('partials.profile.delete_profile')
@include('partials.profile.promote-modal')
@include('partials.profile.demote-modal')
@include('partials.profile.block-modal')
@include('partials.profile.contest-modal', ['user' => $user])
@endsection