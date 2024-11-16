@extends('layouts.app')

@php
    $showFooter = false;
@endphp

@section('content')
    <!-- Great Project -->
    <section class="great-project-section cars">
        <div class="project-info">
            <h2 class="project-title">{{ ucwords($brand->name) }} Cars</h2>
            <p class="project-description">This is a people-say of our awesome {{ ucwords($brand->name) }}</p>
        </div>


        <div class="project-carousel">
            <div class="card-cars">
                @foreach ($items as $item)
                    <div class="card cars">
                        <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="Project 1">
                        <div class="card-content">
                            <h1 class="card-title">{{ ucwords($item->name) }} </h1>
                            <p class="card-description">Rp {{ number_format($item->price, 0, ' ') }}/day</p>
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
