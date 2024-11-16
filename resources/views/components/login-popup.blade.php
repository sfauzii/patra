<!-- resources/views/components/login-popup.blade.php -->
<div id="login-popup" class="login-popup">
    <button class="close-button-popup" onclick="document.getElementById('login-popup').style.display='none';">
        &times;
    </button>
    <div class="card login-card">
        <div class="row no-gutters">
            <!-- Left side with background image -->
            <div class="col-md-6 login-image"></div>

            <!-- Right side with login form -->
            <div class="col-md-6">
                <div class="card-body login-content">
                    <h2 class="title-login">Login</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror rounded-input" id="email"
                                placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email"
                                autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror rounded-input"
                                id="password" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                        @endif
                        <div class="action-buttons">
                            <button type="submit" class="login-button">Login</button>
                            <button type="button" class="register-button"
                                onclick="window.location.href = '{{ route('register') }}';">Register</button>
                        </div>

                        <hr>
                        <div class="action-buttons">
                            <button type="button" class="btn-dark google"
                                onclick="window.location.href = 'register.html';">
                                <img src="{{ url('frontend/images/icon-google.svg') }}" alt="Google Icon"
                                    class="google-icon">
                                Masuk/Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
