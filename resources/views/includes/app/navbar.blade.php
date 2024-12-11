<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <div class="logo">
            <a href="/"><img src="{{ url('frontend/images/logo.svg') }}" alt="Logo" /></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cars') ? 'active' : '' }}"
                        href="{{ route('cars') }}">Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="btn-container">
                <div class="btn-container">
                    <div class="search-icon-container" onclick="Livewire.dispatch('search-modal')">
                        <i class="fas fa-search"></i>
                    </div>
                    @if (Auth::check())
                        <!-- Tampilkan tombol Logout jika pengguna sudah login -->
                        <form action="{{ route('logout') }}" method="POST" class="mr-2">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Logout</button>
                        </form>

                        <button onclick="window.location.href='{{ route('check-booking') }}';"
                            class="btn btn-primary">My
                            Booking</button>
                    @else
                        <!-- Tampilkan tombol Login jika pengguna belum login -->
                        <button id="login-btn" href="{{ route('login') }}" class="btn btn-primary">Login</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
