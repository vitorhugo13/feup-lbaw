@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet">
@endpush

@section('main-content')

<h1>Edit Profile</h1>
<div class="d-flex align-items-center flex-wrap justify-content-center">
    <div class="edit-profile-info d-flex flex-column align-items-center flex-fill">
        <!--TODO: change photo-->
        <img src="{{asset('images/' . $user->photo)}}" class="img rounded-circle  " alt="Profile photo">

        <form class="d-flex flex-column align-items-center" method="post" action="{{ url('users/'  . $user->id . '/edit/photo') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <button type="submit" class="btn">Change photo</button>
        </form>


        <form class="d-flex flex-column align-items-center" method="POST" action="{{ url('users/' . $user->id.'/edit/bio') }}" >
            {{ csrf_field() }}
            <textarea rows="5" cols="30" class="mt-3" name="body">{{$user-> bio == null ? 'Write something about yourself' : $user->bio }}</textarea>
            <button type="submit" class="mt-1 btn">Update bio</button>
        </form>


    </div>


    <div class="form-box d-flex flex-column  align-items-center flex-grow-1">
        <form method="post" action="{{ url('users/'  . $user->id . '/edit/credentials') }}">
            {{ csrf_field() }}
            <div class="form-input">
                <span> <i class="fa fa-user"></i></span>
            <input type="text" value="{{$user-> username}}">
            </div>

            <div class="form-input">
                <span> <i class="fa fa-envelope"></i></span>
                <input type="text" value="{{$user-> email}}">
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" placeholder="Old Password" required>
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" placeholder="New Password" required>
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" placeholder="Repeat New Password" required>
            </div>


            <div class="changes-buttons text-right mb-3">
                <a href="{{url('users/' . $user->id) }}">Discard changes</a>
                <button type="submit" class="btn">Save changes</button>
            </div>

        </form>
    </div>
</div>


@endsection