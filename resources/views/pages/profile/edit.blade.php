@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/errors.css') }}" rel="stylesheet">
    <link href="{{ asset('css/constants.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/password.js') }}" defer></script>
    <script src="{{ asset('js/api/delete_photo.js') }}" defer></script>
@endpush

@section('main-content')

<h1>Edit Profile</h1>
<div class="d-flex align-items-center flex-wrap justify-content-center">

    <div class="edit-profile-info d-flex flex-column align-items-center flex-fill">
        
        <form class="d-flex flex-column align-items-center change-photo" method="post" action="{{ route('changePhoto', $user->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <img src="{{ asset($user->photo) }}" class="img rounded-circle" alt="Profile photo">
            <input type="file" name="avatar">

            @if ($errors->has('avatar'))
                <span class="error3">
                    {{ $errors->first('avatar') }}
                </span>
            @endif

            <div class="mt-2">
                <a class="btn" id="btn-2"> Delete photo</a>
                <button type="submit" class="btn" id="btn-3" >Change photo</button>
            </div>
        </form>

        <form class="d-flex flex-column align-items-center " method="POST" action="{{ url('users/' . $user->id.'/edit/bio') }}" >
            {{ csrf_field() }}
            
            <textarea rows="5" cols="30" class="mt-3" name="body">{{$user-> bio == null ? 'Write something about yourself' : $user->bio }}</textarea>

            @if ($errors->has('body'))
                <span class="error" style=" padding-bottom: 0; margin-left: 6.2em;">
                    {{ $errors->first('body') }}
                </span>
            @endif
            <button type="submit" class="mt-1 btn">Update bio</button>
        </form>

    </div>


    <div class="form-box d-flex flex-column  align-items-center flex-grow-1 credentials">
        <form method="post" action="{{ url('users/'  . $user->id . '/edit/credentials') }}">
            {{ csrf_field() }}

            <div class="form-input">
                <span> <i class="fa fa-user"></i></span>
                <input type="text" name="username" value="{{$user-> username}}" placeholder="Username" required>

                @if ($errors->has('username'))
                    <p class="error2">
                        {{ $errors->first('username') }}
                    </p>
                @endif

            </div>
            

            <div class="form-input d-flex flex-column">
                <span> <i class="fa fa-envelope"></i></span>
                <input type="email" name="email" value="{{$user-> email}}" placeholder="Email" required>

                @if ($errors->has('email'))
                    <p class="error2">
                        {{ $errors->first('email') }}
                    </p>
                @endif

            </div>


            <div class="form-input d-flex flex-column">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" name="old_pass" class="old_pass" placeholder="Old Password" >

                @if ($errors->has('old_pass'))
                    <p class="error2">
                        {{ $errors->first('old_pass') }}
                    </p>
                @endif

            </div>


            <div class="form-input d-flex flex-column">
                <span> <i class="fa fa-lock"></i></span>
                <input type="password" name="password" class="password" placeholder="New Password">

                @if ($errors->has('password'))
                   <p class="error2">
                       {{ $errors->first('password') }}
                   </p>
               @endif

            </div>


            <div class="form-input d-flex flex-column">
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