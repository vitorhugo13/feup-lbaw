@extends('layouts.headerless')

@section('content')

{{-- <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type="submit">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form> --}}

@push('styles')
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 col-md-6 form-container">

      <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">

        <div class="logo mt-5 mb-3">
          <a href=""><img src={{ asset('images/lama_logo.svg') }} width="140px"></a>
        </div>

        <div class="heading mb-3">
          <h4>Login into your account</h4>
        </div>

        <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

          <div class="form-input">
            <span> <i class="fa fa-user"></i></span>
            <input type="text" name="username" placeholder="Username" required autofocus>
            @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
            </span>
            @endif
          </div>

          <div class="form-input">
            <span> <i class="fa fa-lock"></i></span>
            <input type="password" name="password" placeholder="Password" required>
            @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
            @endif
          </div>

          <div class="row mb-3">
            <div class="col-6 d-flex">
            </div>
            <div class="col-6 text-right">
              <a href="#" class="forget-link">Forgot password</a>
            </div>
          </div>

          <div class="text-center mb-3">
            <button type="submit" class="btn" >Log in</button>
          </div>

          <h6><span> or login with </span></h6>

          <div class="google mb-3">

            <a href="" class="btn btn-block btn-social btn-google">Google</a>

          </div>

          <div class="register-account">
            Don't have an account?
            <a class="register-link" href="{{ route('register') }}"> Register here.</a>
          </div>

        </form>

      </div>
    </div>

    <div class="col-lg-6 col-md-6 d-none d-md-block image-container"></div>

  </div>
</div>

@endsection


