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
                <li class="nav-item dropdown position-static">
                    <a class="nav-link {{ request()->is('cars') || request()->is('motorcycle') ? 'active' : '' }}"
                        href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Services
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-down ms-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        </svg>
                        <!-- <i class="fa fa-chevron-down ms-2"></i>  -->
                    </a>
                    <div class="mega-menu dropdown-menu w-100" aria-labelledby="servicesDropdown">
                        <div class="container-fluid px-5">
                            <div class="row">
                                <div class="col-5 mega-left-column">
                                    <div class="mega-left-content position-relative">
                                        <img src="frontend/images/bg-login.svg" alt="Services Background"
                                            class="mega-left-bg-image">
                                        <div class="mega-left-overlay"></div>
                                        <div class="mega-left-text position-absolute bottom-0 start-0 p-4 text-white">
                                            <h4 class="subtitle-mega-left opacity-75">Our Services</h4>
                                            <h2 class="mb-3">Comprehensive Transportation Solutions</h2>
                                            <p>Discover our range of premium transportation services tailored to
                                                meet your unique needs.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7 mega-right-column">
                                    <div class="mega-menu-services">
                                        <div class="mega-menu-item d-flex align-items-center mb-3">
                                            <div class="mega-menu-icon me-3">
                                                <img src="{{ url('frontend/images/smart-car.svg') }}" alt="Car Service"
                                                    class="service-icon">
                                            </div>
                                            <div class="mega-menu-text">
                                                <a href="{{ route('cars') }}">
                                                    <h3 class="mb-1">Car Services</h3>
                                                </a>
                                                <p class="text-muted">Explore our comprehensive car
                                                    transportation solutions</p>
                                            </div>
                                        </div>
                                        <div class="mega-menu-item d-flex align-items-center">
                                            <div class="mega-menu-icon me-3">
                                                <img src="{{ url('frontend/images/status-up.svg') }}"
                                                    alt="Motorcycle Service" class="service-icon">
                                            </div>
                                            <div class="mega-menu-text">
                                                <a href="">
                                                    <h3 class="mb-1">Motorcycle Services</h3>
                                                </a>
                                                <p class="text-muted">Discover our innovative motorcycle
                                                    transportation options</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
