@extends('layouts.headerless')

@section('content')

@push('styles')
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link href="{{ asset('css/errors.css') }}" rel="stylesheet">
@endpush

{{-- TODO: css for the errors --}}
<div class="container-fluid">
  <div class="row">
      <div class="col-lg-6 col-md-6 d-none d-md-block image-container"></div>

      <div class="col-lg-6 col-md-6 form-container">
          <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
              <div class="logo mt-5 mb-3">
                  <a href=""><img src={{ asset('images/lama_logo.svg') }} width="140px"></a>
              </div>

              <div class="heading mb-3">
                  <h4>Create new account</h4>
              </div>
                  
              <form method="POST" action="{{ route('register') }}">
              {{ csrf_field() }}

                  <div class="form-input">
                      <span> <i class="fa fa-user"></i></span>
                  <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                      
                  </div>
                    
                  <div class="form-input">
                      <span> <i class="fa fa-envelope"></i></span>
                      <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                  </div>

                  <div class="form-input">
                      <span> <i class="fa fa-lock"></i></span>
                      <input type="password" name="password" placeholder="Password" required>
                      
                  </div>

                  <div class="form-input">
                      <span> <i class="fa fa-lock"></i></span>
                      <input type="password" name="password_confirmation" placeholder="Repeat Password" required>
                  </div>

                @if ($errors->has('username'))
                      <span class="error">
                          {{ $errors->first('username') }}
                      </span>
                @endif
                @if ($errors->has('email'))
                      <span class="error">
                          {{ $errors->first('email') }}
                      </span>
                @endif
                @if ($errors->has('password'))
                      <span class="error">
                          {{ $errors->first('password') }}
                      </span>
                @endif

                  <div class="text-center mb-3">
                      <button type="submit" class="btn">Register</button>
                  </div>
                    
                  <h6><span>or register with</span></h6>
                                    
                  <div class="google mb-3">         
                      <a href="" class="btn btn-block btn-social btn-google">Google</a>          
                  </div>
                    
                  <div class="text-white">
                  Already have an account?
                  <a href="{{ route('login') }}" class="register-link"> Log in here.</a>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection
