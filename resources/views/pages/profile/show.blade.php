@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post_elems.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/api/star.js') }}" defer></script>
    <script src="{{ asset('js/api/rating.js') }}" defer></script>
@endpush

@section('main-content')
  
<section class="row justify-content-center">
    <article class="user-info col-12 col-lg-5 d-flex flex-column justify-content-center align-items-center">
    <!--TODO: change directory -->
    <img src="{{asset('images/' . $user->photo)}}" class="img rounded-circle" alt="Profile photo">
        <div class="username d-flex flex-row align-items-center mt-3">
        <p>{{ $user-> username}}</p>
            <div class="dropdown col-1">
                <div data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Promote</a>
                    <a class="dropdown-item" href="#">Demote</a>
                    <a class="dropdown-item" href="#">Report</a>
                    <a class="dropdown-item" href="#">Block</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Delete</a>
                </div>
            </div>
        </div>
        <!--TODO: newlines/ format text-->
        <p class="bio text-left">{{$user->bio}} </p>
        <a class="edit-button" href="{{url('users/' . $user->id . '/edit')}}"><strong>Edit profile</strong></a>

        @if($user->release_date > 0)
            <div id="blocked" class="mt-5">
            <!--TODO: display remaining time -->
                <p class="blocked-text mb-1">You are blocked for:</p>
                <p class="remaining-time">49h 30m 06s</p>
                <button class="contest-button"><i class="fas fa-exclamation-circle"></i><strong> Contest</strong></button>
            </div>
        @endif
        
    </article>
    <article class="points-info col-12 col-lg-6 d-flex flex-column justify-content-around align-items-stretch ml-0 ml-lg-4 mt-4 mt-lg-0">
        <div class="glory-points d-flex flex-column justify-content-center align-self-center d-flex flex-column align-items-center">
        <img src="{{asset('images/gold_llama.svg')}}" alt="photo">
            <p>&diams; <?= $user->glory . (($user->glory == 1) ? ' point' : ' points') ?> &diams;</p>
        </div>
        <hr>
        <div class="top-categories">
         <!--TODO: query to get top categories-->
            <h3>Top Categories</h3>
            <div class="top-category d-flex justify-content-between">
                <span><i class="fas fa-medal mr-2"></i> ! Sports</span>
                <span>8567</span>
            </div>

            <div class="top-category d-flex justify-content-between">
                <span><i class="fas fa-medal mr-2"></i> ! Economy</span>
                <span>2103</span>
            </div>

            <div class="top-category d-flex justify-content-between">
                <span><i class="fas fa-medal mr-2"></i> ! Music</span>
                <span>783</span>
            </div>
        </div>
    </article>
</section>

<div class="post-section">
    {{-- FIXME: count only the visible posts --}}
    <p class="number-posts ml-1 mb-2"> <strong>Posts</strong> ({{count($user->posts)}})</p>
    @each('partials.posts.preview', $user->posts, 'post')
</div>

@endsection