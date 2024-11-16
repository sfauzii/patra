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
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cars') }}">Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
            <div class="btn-container">
                <div class="btn-container">
                    <div class="search-icon-container" onclick="Livewire.dispatch('search-modal')">
                        <i class="fas fa-search"></i>
                    </div>
                    @if (Auth::check())
                        <!-- Tampilkan tombol Logout jika pengguna sudah login -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    @else
                        <!-- Tampilkan tombol Login jika pengguna belum login -->
                        <button id="login-btn" href="{{ route('login') }}" class="btn btn-primary">Login</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
