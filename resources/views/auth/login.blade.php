@extends('layouts.app')

@php
    $showFooter = false;
    $showNavbar = false;
@endphp

@section('content')
 

    <section class="register">
        <div class="register-container">
            <div class="register-left">
                <!-- Background image will be set via CSS -->
            </div>
            <div class="register-right">
                <div class="logo-container">
                    <a href="/"><img src="frontend/images/logo.svg" alt="Logo" class="logo"></a>
                </div>
                <div class="register-header">
                    <h2>Login Account</h2>
                    <p>Enter your email and password <br> to access your account.</p>
                </div>
                <div class="register-card">
                    <form method="POST" action="{{ route('login') }}" class="register-form">
                        @csrf

                        <div class="form-group">
                            <p class="form-label">Email Address</p>
                            <input type="email" class="form-input @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <p class="form-label">Password</p>
                            <input type="password" class="form-input @error('password') is-invalid @enderror"
                                name="password" placeholder="Enter a password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>



                        <div class="row mb-4">
                            <div class="col-md-12">
                                @if (Route::has('password.request'))
                                    <a class="d-block text-end" href="{{ route('password.request') }}"
                                        style="color: #6B7280; text-decoration: none; ">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>


                        <button type="submit" class="btn-register">Login</button>

                        <!-- <button type="button" class="btn-login">Login</button> -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
