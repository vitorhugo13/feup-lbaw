@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/password.js') }}" defer></script>
@endpush

@section('main-content')

<h1>Edit Profile</h1>
<div class="d-flex align-items-center flex-wrap justify-content-center">
    <div class="edit-profile-info d-flex flex-column align-items-center flex-fill">
        
        <form class="d-flex flex-column align-items-center" method="post" action="{{ route('changePhoto', $user->id) }}" enctype="multipart/form-data">
            @csrf
            <img src="{{ asset($user->photo) }}" class="img rounded-circle" alt="Profile photo">
            <input type="file" name="avatar">
            <button type="submit" class="btn">Change photo</button>
        </form>

        <form class="d-flex flex-column align-items-center" method="POST" action="{{ url('users/' . $user->id.'/edit/bio') }}" >
            {{ csrf_field() }}
            
            <textarea rows="5" cols="30" class="mt-3" name="body">{{$user-> bio == null ? 'Write something about yourself' : $user->bio }}</textarea>
            <button type="submit" class="mt-1 btn">Update bio</button>
        </form>


    </div>


    <div class="form-box d-flex flex-column  align-items-center flex-grow-1 credentials">
        <form method="post" action="{{ url('users/'  . $user->id . '/edit/credentials') }}">
            {{ csrf_field() }}

            <div class="form-input">
                <span> <i class="fa fa-user"></i></span>
            <input type="text" name="username" value="{{$user-> username}}" placeholder="Username" required>
            </div>

            <div class="form-input">
                <span> <i class="fa fa-envelope"></i></span>
                <input type="email" name="email" value="{{$user-> email}}" placeholder="Email" required>
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" name="old_pass" class="old_pass" placeholder="Old Password" >
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" name="password" class="password" placeholder="New Password">
            </div>

            <div class="form-input">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" name="password_confirmation" class="password_confirmation" placeholder="Repeat New Password">
            </div>


            <div class="changes-buttons text-right mb-3">
                <a href="{{url('users/' . $user->id) }}">Discard changes</a>
                <button type="submit" class="btn">Save changes</button>
            </div>

        </form>
    </div>
</div>


@endsection