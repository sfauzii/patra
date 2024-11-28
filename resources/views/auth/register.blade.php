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
                <h2>New Account</h2>
                <p>Lengkapi form di bawah dengan <br> menggunakan data Anda yang valid</p>
            </div>
            <div class="register-card">
                <form method="POST" action="{{ route('register') }}" class="register-form">
                    @csrf
                    <div class="form-group">
                        <p class="form-label">Name</p>
                        <input type="text" class="form-input @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Enter your full name" required autocomplete="name"
                            autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
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
                            name="password" placeholder="Create a password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p class="form-label">Password</p>
                        <input type="password" class="form-input" name="password_confirmation"
                            placeholder="Confirm a password" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn-register">Register Now</button>
                    <button type="button" class="btn-register login"
                        onclick="window.location.href = '{{ route('login') }}';">Login</button>
                    <!-- <button type="button" class="btn-login">Login</button> -->
                </form>
            </div>
        </div>
    </div>
</section>

@endsection