@extends('layouts.app')

@section('content')
    <div class="guest-header text-center mb-5">
        <h1 style="font-weight: 700">{{ __('Sign Up') }}</h1>
        <p>Connect Anytime, Anywhere Intuitive Hotspot Made Perfect!</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <p class="mb-1 input-label">{{ __('First_name') }}</p>

                <div class="d-block">
                    <input id="first-name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required placeholder="Enter your first name" autocomplete="first_name" autofocus>

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <p class="mb-1 input-label">{{ __('Last_name') }}</p>

                <div class="d-block">
                    <input id="last-name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter your last name" autocomplete="last_name" autofocus>

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <p class="mb-1 input-label">{{ __('Email Address') }}</p>

                <div class="d-block">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter your email or username" autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <p class="mb-1 input-label">{{ __('Phone Number') }}</p>

                <div class="d-block">
                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Enter your Phone Number" autocomplete="phone_number" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-3">
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

            <div class="col-md-6 mb-3">
                <p class="mb-1 input-label">{{ __('Confirm Password') }}</p>

                <div class="">
                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="Confirm your Password"  autocomplete="current-password">

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn d-block login-btn mt-4" style="width: 100%;">
                    {{ __('Sign Up') }}
                </button>
                <p class="text-secondary mt-3 text-center">
                    Already a member? <a href="/login" class="text-dark">Login</a>
                </p>
            </div>
        </div>
    </form>
@endsection
