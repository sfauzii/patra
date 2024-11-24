@extends('layouts.app')

@section('content')
    <!-- Login Popup (this part is added to the index.html) -->
    <x-login-popup />


    <section class="header-content">
        <div class="left-content">
            <h1>Fast and Easy Way To Rent A Car</h1>
            <p>Discover the fastest and most convenient way to rent a car, ensuring a smooth and stress-free experience
                every time.</p>

            {{-- <div class="card-search">
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
            </div> --}}

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
            <p>Browse various categories to find the perfect car for your needs.</p>
        </div>


        <div class="cars-container">
            @foreach ($brands as $brand)
                <div class="car-card" onclick="window.location.href = '{{ route('view.brands', $brand->name) }}';"
                    style="cursor: pointer;">
                    <img src="{{ asset('storage/' . $brand->icon_images) }}" alt="Car 1" class="car-image">
                    <div class="car-info">
                        <h1 class="car-title">{{ ucwords($brand->name) }}</h1>
                        <p class="car-description">Explore all cars from the brand
                            <strong>{{ ucwords($brand->name) }}</strong> available
                            here.
                        </p>
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
                @foreach ($firstItems as $item)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="{{ $item->name }}">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($item->name) }} </h1>
                            <p class="card-description">Rp {{ number_format($item->price, 0, '') }}/day</p>
                            <div class="card-rating">
                                @php
                                    $avgRating = number_format($item->avg_rating, 1);
                                    $fullStars = floor($avgRating);
                                    $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                    $emptyStars = 5 - ($fullStars + ($hasHalfStar ? 1 : 0));
                                @endphp

                                {{-- Bintang Penuh --}}
                                @for ($i = 1; $i <= $fullStars; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor

                                {{-- Setengah Bintang --}}
                                @if ($hasHalfStar)
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @endif

                                {{-- Bintang Kosong --}}
                                @for ($i = 1; $i <= $emptyStars; $i++)
                                    <i class="far fa-star text-secondary"></i>
                                @endfor

                                <!-- Jumlah Ulasan -->
                                <span class="review-count">({{ $item->review_count }} Reviews)</span>
                                <!-- Example of a half-star -->
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
                @foreach ($secondItems as $item)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="{{ $item->name }}">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($item->name) }} </h1>
                            <p class="card-description">Rp {{ number_format($item->price, 0, '') }}/day</p>
                            <div class="card-rating">
                                @php
                                    $avgRating = number_format($item->avg_rating, 1);
                                    $fullStars = floor($avgRating);
                                    $hasHalfStar = $avgRating - $fullStars >= 0.5;
                                    $emptyStars = 5 - ($fullStars + ($hasHalfStar ? 1 : 0));
                                @endphp

                                {{-- Bintang Penuh --}}
                                @for ($i = 1; $i <= $fullStars; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor

                                {{-- Setengah Bintang --}}
                                @if ($hasHalfStar)
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @endif

                                {{-- Bintang Kosong --}}
                                @for ($i = 1; $i <= $emptyStars; $i++)
                                    <i class="far fa-star text-secondary"></i>
                                @endfor

                                <!-- Jumlah Ulasan -->
                                <span class="review-count">({{ $item->review_count }} Reviews)</span>
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
                        <p class="how-it-works-desc">Select your preferred rental car.</p>
                    </div>
                </div>

                <div class="icon-section">
                    <div class="icon-card">
                        <img src="{{ url('frontend/images/icon-calender.svg') }}" alt="Icon 2" class="how-it-works-icon">
                    </div>
                    <div class="how-it-works-text">
                        <h2 class="how-it-works-title">Pickup Date</h2>
                        <p class="how-it-works-desc">Schedule your vehicle pickup date.</p>
                    </div>
                </div>

                <div class="icon-section">
                    <div class="icon-card">
                        <img src="{{ url('frontend/images/icon-document-text.svg') }}" alt="Icon 3"
                            class="how-it-works-icon">
                    </div>
                    <div class="how-it-works-text">
                        <h2 class="how-it-works-title">Document Validation</h2>
                        <p class="how-it-works-desc">Verify required documents for booking.</p>
                    </div>
                </div>

                <div class="icon-section">
                    <div class="icon-card">
                        <img src="{{ url('frontend/images/icon-payment.svg') }}" alt="Icon 3" class="how-it-works-icon">
                    </div>
                    <div class="how-it-works-text">
                        <h2 class="how-it-works-title">Payment</h2>
                        <p class="how-it-works-desc">Complete payment to confirm booking.</p>
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
            <p class="people-say-desc">Read reviews and feedback from our satisfied customers.</p>

            <!-- car-reviews people-say (Scrollable Cards) -->
            <div class="car-reviews-wrapper">
                <!-- Single car-review Card -->
                @foreach ($randomReviews as $review)
                    <div class="car-review-card">
                        <div class="car-review-footer">
                            <img class="author-photo"
                                src="{{ $review->user->profile_photo_url ?? 'https://api.dicebear.com/6.x/initials/svg?seed=' . urlencode($review->user->name) }}"
                                alt="{{ ucwords($review->user->name) }}">
                            <div class="car-review-info">
                                <p class="author-name">{{ ucwords($review->user->name) }}</p>
                                <div class="card-rating-review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                                </div>
                            </div>
                        </div>
                        <h2 class="car-review-title">{{ ucwords($review->item->name) }} </h2>
                        <p class="car-review-description">"{{ ucfirst($review->message) }}"</p>
                    </div>
                @endforeach



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
                    <span>How can I modify my booking?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        Once an order is placed, modifications can only be made within 24 hours. Please contact our customer
                        service immediately for assistance.
                    </p>
                </div>
            </div>

            <div class="faq-card" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>How can I track my booking?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        You can track your order using the booking code sent to your email.
                    </p>
                </div>
            </div>
            <div class="faq-card" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>What documents are required for validation?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        You will need to provide your KTP, KK or BPJS, and any additional documents specified during payment
                        for validation.
                    </p>
                </div>
            </div>
            <div class="faq-card" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <span>What payment methods do you accept?</span>
                    <i class="faq-icon">+</i>
                </div>
                <div class="faq-answer">
                    <p>
                        We use Midtrans as our payment gateway, supporting various methods including e-wallet and bank
                        transfers.
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
                    <h1>Start Your Journey Today</h1>
                    <p>Discover the convenience and flexibility of our car rental services, designed to make your travels
                        easier and more enjoyable.</p>
                    <button class="explore-button" onclick="window.location.href='{{ route('cars') }}';">Explore
                        More</button>
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
