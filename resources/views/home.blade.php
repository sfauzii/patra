@extends('layouts.app')

@section('content')
    <!-- Login Popup (this part is added to the index.html) -->
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
                        <!-- <img src="frontend/images/logo.svg" alt="Logo" class="logo-img-login"> -->
                        <h2 class="title-login">Login</h2>
                        <!-- <p class="desc-login">Lengkapi form di bawah dengan menggunakan data Anda yang valid</p> -->
                        <!-- <div class="card-form-login"> -->
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
                                <button type="button" class="register-button" onclick="window.location.href = '{{ route('register') }}';">Register</button>
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
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="header-content">
        <div class="left-content">
            <h1>Fast and Easy Way To Rent A Car</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto molestias aspernatur, delectus
                suscipit autem ut.</p>

            <div class="card-search">
                <form>
                    <input type="text" placeholder="Search...">
                    <select>
                        <option value="">Select Brand</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                    </select>
                    <select>
                        <option value="">Select Type</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                    </select>
                    <button class="btn-primary" type="submit">Search</button>
                </form>
            </div>

            <!-- Tambahkan gambar di sini -->
            <div class="extra-image">
                <img src="{{ url('frontend/images/list-many-more.svg') }}" alt="Car Rental" />
            </div>

            <!-- New Image Below Card Search -->
        </div>
        <div class="right-content">
            <img src="{{ url('frontend/images/hero.svg') }}" alt="Image" />
        </div>
    </section>

    <section class="category-cars-section">

        <div class="explore-header-category">
            <h1>Explore By Category</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga.</p>
        </div>


        <div class="cars-container">
            @foreach ($brands as $brand)
                <div class="car-card">
                    <img src="{{ asset('storage/' . $brand->icon_images) }}" alt="Car 1" class="car-image">
                    <div class="car-info">
                        <h1 class="car-title">{{ ucwords($brand->name) }}</h1>
                        <p class="car-description">Semua dengan brand {{ ucwords($brand->name) }} bisa kamu liat disini</p>
                    </div>
                </div>
            @endforeach


        </div>
    </section>

    <!-- Great Project -->
    <section class="great-project-section">
        <div class="project-info">
            <h2 class="project-title">Great Cars</h2>
            <p class="project-description">This is a people-say of our awesome cars</p>
        </div>

        <div class="project-carousel">
            <!-- Card Row 1 (Scrolling Animation) -->
            <div class="card-container">
                @foreach ($items as $item)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="{{ $item->name }}">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($item->name) }} </h1>
                            <p class="card-description">Rp {{ number_format($item->price, 0, '') }}/day</p>
                            <div class="card-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                            <button class="view-details"
                                onclick="window.location.href='{{ route('item.details', $item->slug) }}';">View
                                Details</button>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <!-- Card Row 2 (Different Animation) -->
        <div class="project-carousel reverse">
            <div class="card-container">
                @foreach ($items as $item)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="{{ $item->name }}">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($item->name) }} </h1>
                            <p class="card-description">Rp {{ number_format($item->price, 0, '') }}/day</p>
                            <div class="card-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                            <button class="view-details"
                                onclick="window.location.href='{{ route('item.details', $item->slug) }}';">View
                                Details</button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="how-it-works-container">
            <!-- Image on the left -->
            <img src="{{ url('frontend/images/how-it-works.svg') }}" alt="How It Works" class="how-it-works-image">
            <!-- Icons on the right -->
            <div class="how-it-works-icons">
                <div class="how-it-works-header">
                    <h1>How It Works</h1>
                    <p>Learn the simple steps to get started.</p>
                </div>
                <div class="icon-section">
                    <div class="icon-card">
                        <img src="{{ url('frontend/images/icon-car.svg') }}" alt="Icon 1" class="how-it-works-icon">
                    </div>
                    <div class="how-it-works-text">
                        <h2 class="how-it-works-title">Choose Car</h2>
                        <p class="how-it-works-desc">This is the first step description.</p>
                    </div>
                </div>

                <div class="icon-section">
                    <div class="icon-card">
                        <img src="{{ url('frontend/images/icon-calender.svg') }}" alt="Icon 2"
                            class="how-it-works-icon">
                    </div>
                    <div class="how-it-works-text">
                        <h2 class="how-it-works-title">Pickup Date</h2>
                        <p class="how-it-works-desc">This is the second step description.</p>
                    </div>
                </div>

                <div class="icon-section">
                    <div class="icon-card">
                        <img src="{{ url('frontend/images/icon-payment.svg') }}" alt="Icon 3"
                            class="how-it-works-icon">
                    </div>
                    <div class="how-it-works-text">
                        <h2 class="how-it-works-title">Payment</h2>
                        <p class="how-it-works-desc">This is the third step description.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What People Say -->
    <section class="people-say-car-reviews">
        <div class="container">
            <!-- Title -->
            <h1 class="people-say-title">What People Say</h1>
            <p class="people-say-desc">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

            <!-- car-reviews people-say (Scrollable Cards) -->
            <div class="car-reviews-wrapper">
                <!-- Single car-review Card -->
                <div class="car-review-card">
                    <div class="car-review-footer">
                        <img class="author-photo" src="{{ url('frontend/images/hero.svg') }}" alt="Author Photo">
                        <div class="car-review-info">
                            <p class="author-name">Author Name</p>
                            <div class="card-rating-review">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                        </div>
                    </div>
                    <h2 class="car-review-title">car-review Title </h2>
                    <p class="car-review-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Pariatur alias assumenda in quaerat vero magnam con</p>
                </div>
                <div class="car-review-card">
                    <div class="car-review-footer">
                        <img class="author-photo" src="{{ url('frontend/images/hero.svg') }}" alt="Author Photo">
                        <div class="car-review-info">
                            <p class="author-name">Author Name</p>
                            <div class="card-rating-review">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                        </div>
                    </div>
                    <h2 class="car-review-title">Title Review</h2>
                    <p class="car-review-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Pariatur alias assumenda in quaerat vero magnam con</p>
                </div>
                <div class="car-review-card">
                    <div class="car-review-footer">
                        <img class="author-photo" src="{{ url('frontend/images/hero.svg') }}" alt="Author Photo">
                        <div class="car-review-info">
                            <p class="author-name">Author Name</p>
                            <div class="card-rating-review">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                        </div>
                    </div>
                    <h2 class="car-review-title">car-review Title </h2>
                    <p class="car-review-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Pariatur alias assumenda in quaerat vero magnam con</p>
                </div>
                <div class="car-review-card">
                    <div class="car-review-footer">
                        <img class="author-photo" src="{{ url('frontend/images/hero.svg') }}" alt="Author Photo">
                        <div class="car-review-info">
                            <p class="author-name">Author Name</p>
                            <div class="card-rating-review">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                        </div>
                    </div>
                    <h2 class="car-review-title">car-review Title </h2>
                    <p class="car-review-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Pariatur alias assumenda in quaerat vero magnam con</p>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section">
        <div class="faq-container">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <p class="faq-description">
                Find answers to the most commonly asked questions below.
            </p>

            <div class="faq-card" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>What is your return policy?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        We accept returns within 30 days of purchase. Please ensure the
                        items are in their original condition.
                    </p>
                </div>
            </div>

            <div class="faq-card" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>How can I track my order?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        You can track your order using the tracking link provided in
                        your shipping confirmation email.
                    </p>
                </div>
            </div>
            <div class="faq-card" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>How can I track my order?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        You can track your order using the tracking link provided in
                        your shipping confirmation email.
                    </p>
                </div>
            </div>
            <div class="faq-card" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>How can I track my order?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        You can track your order using the tracking link provided in
                        your shipping confirmation email.
                    </p>
                </div>
            </div>

            <!-- Add more FAQ cards as needed -->
        </div>
    </section>

    <!-- START GROWING TODAY -->
    <section class="start-growing-today">
        <div class="growing-container">
            <div class="main-card">
                <div class="main-content">
                    <h1>Start Growing Today</h1>
                    <p>Discover the benefits of our services and how they can help you grow your business.</p>
                    <button class="explore-button">Explore More</button>
                </div>
                <div class="icon-cards-growing">
                    <div class="icon-card-growing">
                        <img src="{{ url('frontend/images/cloud-add.svg') }}" alt="Icon 1" class="icon-image-growing">
                        <h3>Super Reliable</h3>
                    </div>
                    <div class="icon-card-growing">
                        <img src="{{ url('frontend/images/smart-car.svg') }}" alt="Icon 2" class="icon-image-growing">
                        <h3>Nice Car</h3>
                    </div>
                    <div class="icon-card-growing">
                        <img src="{{ url('frontend/images/status-up.svg') }}" alt="Icon 3" class="icon-image-growing">
                        <h3>Power Up</h3>
                    </div>
                    <div class="icon-card-growing">
                        <img src="{{ url('frontend/images/wallet-search.svg') }}" alt="Icon 4"
                            class="icon-image-growing">
                        <h3>Easy Book</h3>
                    </div>
                    <div class="icon-card-growing">
                        <img src="{{ url('frontend/images/card-tick.svg') }}" alt="Icon 5" class="icon-image-growing">
                        <h3>Automatic Payment</h3>
                    </div>
                    <div class="icon-card-growing">
                        <img src="{{ url('frontend/images/scanning.svg') }}" alt="Icon 6" class="icon-image-growing">
                        <h3>As You Wish</h3>
                    </div>
                    <!-- Add more icon cards as needed -->
                </div>
            </div>
        </div>
    </section>
@endsection
