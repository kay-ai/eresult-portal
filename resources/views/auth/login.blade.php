@extends('layouts.app')

@section('content')
    <div class="guest-header text-center mb-5">
        <h1 style="font-weight: 700">{{ __('Log in') }}</h1>
        <p>Connect Anytime, Anywhere Intuitive Hotspot Made Perfect!</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <p class="mb-1 input-label">{{ __('Email Address') }}</p>

            <div class="d-block">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter your email or username" autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <p class="mb-1 input-label">{{ __('Password') }}</p>

            <div class="">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password"  autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn d-block login-btn mt-4" style="width: 100%;">
            {{ __('Connect') }}
        </button>

        <div class="d-flex mt-3 mx-1 justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-danger" href="{{ route('forgot.password') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
        <p class="text-secondary mt-3 text-center">Don't have an account? <a href="/register" class="text-dark">Sign Up</a></p>
    </form>
@endsection
