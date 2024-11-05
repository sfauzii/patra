@extends('layouts.app')

@section('content')
    <section class="details">
        <!-- Section Heading with Background Image -->
        <div class="details-background"></div>

        <!-- Content Section -->
        <div class="details-content">
            <div class="heading-content">
                <h1>Car Detail</h1>
                <h3>Home > Car Details</h3>
            </div>

            <!-- Thumbnail Section -->
            <div class="thumbnail-section">
                <div class="thumbnail-card">
                    <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="{{ $item->name }}">
                </div>
            </div>

            <!-- Image Grid Section -->
            <div class="image-grid">
                <!-- <h2>Image Grid Title</h2> -->
                <div class="scroll-container">
                    <!-- <button class="scroll-button left">&lt;</button> -->
                    <div class="grid-images">

                        @if ($item->photos)
                            @foreach (json_decode($item->photos) as $photo)
                                <img src="{{ asset('storage/' . $photo) }}" alt="Image 1"
                                    onclick="openModal('{{ asset('storage/' . $photo) }}')">
                            @endforeach
                        @endif
                    </div>

                    <!-- <button class="scroll-button right">&gt;</button> -->
                </div>
            </div>

            <!-- Two Column Content Section -->
            <div class="content-columns">
                <!-- Left Column -->
                <div class="column-left">
                    <div class="card-car-details">
                        <h2>{{ ucwords($item->name) }}</h2>
                        <span class="badge-category">{{ ucwords($item->type->name) }}</span>
                        <div class="card-rating car-details">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="review-count">{{ $item->review }} Reviews</span><!-- Example of a half-star -->
                        </div>
                        <h4>Description</h4>
                        <p class="description">
                            {!! ucfirst($item->description) !!}
                        </p>
                    </div>
                    <div class="column-left">
                        <div class="card-nav-tabs">
                            <!-- Nav tabs -->
                            <div class="nav-tabs">
                                <button class="tab-btn left-btn-tab active" data-tab="how-it-works">How it
                                    Works</button>
                                <button class="tab-btn right-btn-tab" data-tab="reviews">Reviews</button>
                            </div>
                            <hr class="nav__tabs" style="margin-bottom: 25px;">

                            <!-- Tab Content -->
                            <div class="tab-content" id="how-it-works">
                                <p class="description-how-it">1. Step one... <br> 2. Step two... <br> 3. Step
                                    three...</p>
                                <div class="card-alert">
                                    <img class="alert-icon" src="{{ url('frontend/images/icon-notif.svg') }}"
                                        alt="Alert Icon">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        tempor incididunt ut labore </p>
                                </div>
                            </div>

                            <div class="tab-content" id="reviews" style="display:none;">
                                <div class="review-card">
                                    <div class="review-content">
                                        <img class="profile-photo" src="{{ url('frontend/images/card-tick.svg') }}"
                                            alt="Profile Photo">
                                        <div class="review-details">
                                            <p class="reviewer-name">John Doe</p>
                                            <div class="card-rating-navtabs">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="title__car">Car Model</h3>
                                    <p class="message__review">"This is a great car, I really enjoyed driving it.
                                        The
                                        performance was excellent and it was very comfortable!</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="column-right">
                    <div class="car-informations">
                        <h2>Booking Price</h2>
                        <h2 class="price-car">Rp {{ number_format($item->price) }} <span class="per-day">/day</span></h2>
                        <hr>
                        <h3>The completeness of this car</h3>
                        <ul class="feature-list">
                            @php
                                $features = explode(',', $item->features);
                            @endphp
                            @foreach ($features as $feature)
                                <li><img src="{{ url('frontend/images/checklist.svg') }}" alt="Feature Icon">
                                    {{ $feature }}</li>
                            @endforeach

                            <!-- Add more features as needed -->
                        </ul>
                        <button class="btn-book"
                            onclick="window.location.href='{{ route('checkout', $item->slug) }}';">Proceed to
                            Booking</button>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div id="imageModal" class="modal">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="modalImage">
            </div>




        </div>
    </section>


    <section class="great-project-section details__car">
        <div class="project-info heading__car__details">
            <h2 class="project-title">Other Cars</h2>
            <p class="project-description">This is a people-say of our awesome cars</p>
        </div>

        <div class="project-carousel">
            <!-- Card Row 1 (Scrolling Animation) -->
            <div class="card-container">
                @foreach ($similiarItems as $similiarItem)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($similiarItem->photos)[0]) }}" alt="Project 1">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($similiarItem->name) }} </h1>
                            <p class="card-description">Rp 450.000/day</p>
                            <div class="card-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                            <button class="view-details"
                                onclick="window.location.href='{{ route('item.details', $similiarItem->slug) }}';">View
                                Details</button>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <!-- Card Row 2 (Different Animation) -->
        <div class="project-carousel reverse">
            <div class="card-container">
                @foreach ($similiarItems as $similiarItem)
                    <div class="card">
                        <img src="{{ asset('storage/' . json_decode($similiarItem->photos)[0]) }}" alt="Project 1">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($similiarItem->name) }} </h1>
                            <p class="card-description">Rp 450.000/day</p>
                            <div class="card-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i> <!-- Example of a half-star -->
                            </div>
                            <button class="view-details"
                                onclick="window.location.href='{{ route('item.details', $similiarItem->slug) }}';">View
                                Details</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section car_details_footer">
        <div class="footer-container details__cars">
            <div class="footer-column">
                <img src="{{ url('frontend/images/logo-white.svg') }}" alt="Footer Logo" class="footer-logo">
                <p>Stay connected with us through social media.</p>
                <div class="footer-social-icons">
                    <div class="social-circle">
                        <img src="{{ url('frontend/images/instagram.svg') }}" alt="Icon 1">
                    </div>
                    <div class="social-circle">
                        <img src="{{ url('frontend/images/facebook.svg') }}" alt="Icon 2">
                    </div>
                    <div class="social-circle">
                        <img src="{{ url('frontend/images/whatsapp.svg') }}" alt="Icon 3">
                    </div>
                </div>
            </div>

            <div class="footer-column">
                <h3>Menu</h3>
                <ul class="footer-menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Company</h3>
                <ul class="footer-company">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Location</h3>
                <p class="location-foot"><iframe class="footer-alternatives"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63305.747583945726!2d109.20915013591537!3d-7.397607689588339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655fa48add3e9b%3A0x6719bc889b9b1458!2sPATRA%20Rental%20Mobil%20%26%20Motor%20Purwokerto!5e0!3m2!1sid!2sid!4v1728910690790!5m2!1sid!2sid"
                        width="300" height="150" style="border:0; border-radius: 20px;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Your Company Name. All rights reserved.</p>
        </div>
    </footer>

@endsection
