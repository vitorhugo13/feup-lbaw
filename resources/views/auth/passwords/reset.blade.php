@extends('layouts.headerless')

@push('styles')
<link href="{{ asset('css/common.css') }}" rel="stylesheet">
<link href="{{ asset('css/send_email.css') }}" rel="stylesheet">
<link href="{{ asset('css/reset_pass.css') }}" rel="stylesheet">
<link href="{{ asset('css/errors.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container d-flex flex-column align-items-center mt-4 mt-lg-5 mb-lg-5">
    <div class="logo row justify-content-center mt-lg-5 mb-5">
        <a href="{{ route('home') }}"><img src={{ asset('images/lama_logo.svg') }} width="140px"></a>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="reset_pass p-1 p-lg-2">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-xl-3 col-form-label email_field">{{ __('E-Mail Address:') }}</label>

                            <div class="col-md-8 col-xl-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-xl-3 col-form-label pass_field">{{ __('Password:') }}</label>

                            <div class="col-md-8 col-xl-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-xl-3 col-form-label pass_field">{{ __('Confirm Password:') }}</label>

                            <div class="col-md-8 col-xl-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
