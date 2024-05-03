@extends('layouts.app')

@section('content')
    <div class="guest-header text-center mb-5">
        <h1 style="font-weight: 700">{{ __('Forgot Password') }}</h1>
        <p>Send your email or phone number to retrieve your password</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <p class="mb-1 input-label">{{ __('Email/Phone Number') }}</p>

            <div class="d-block">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter your email or username" autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn d-block login-btn mt-4" style="width: 100%;">
            {{ __('Sign Up') }}
        </button>
        <p class="text-secondary mt-3 text-center">Remember Password? <a href="/login" class="text-dark">Login</a></p>
    </form>
@endsection
