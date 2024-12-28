@extends('layouts.app')

@section('title', 'About')


@section('content')
    <x-login-popup />

    <!-- Section Best About -->
    <section class="best-about">
        <!-- Badge Section -->
        <div class="badge-container">
            <img src="{{ url('frontend/images/icon-global.svg') }}" alt="">
            <p class="badge-text">The best ever car rent in Purwokerto</p>
        </div>

        <!-- Title and Description -->
        <div class="title-container">
            <h1>#1BestCarRental</h1>
            <p class="description">Reliable car rental services with a wide range of vehicles for your travel needs.</p>
        </div>

        <!-- Buttons Section -->
        <div class="buttons-container">
            <button class="button__about btn-get-started" onclick="window.location.href='{{ route('cars') }}';">Get
                Started</button>
            <button class="button__about btn-learn-more">Learn
                More</button>
        </div>

        <!-- Image Section -->
        <img class="about-image" src="{{ url('frontend/images/car-about.svg') }}" alt="About Us">
    </section>


    <!-- Section Trust Us -->
    <section class="trust-me">
        <!-- Card Section -->
        <div class="card-container-about">
            <div class="card-unique">
                <div class="card-content-unique">
                    <img src="{{ url('frontend/images/toyota-white.svg') }}" alt="" class="card-icon-unique">
                    <img src="{{ url('frontend/images/mitsu-white.svg') }}" alt="" class="card-icon-unique">
                    <img src="{{ url('frontend/images/innova-white.svg') }}" alt="" class="card-icon-unique">
                    <img src="{{ url('frontend/images/xenia-white.svg') }}" alt="" class="card-icon-unique">
                    <img src="{{ url('frontend/images/more-white.svg') }}" alt="" class="card-icon-unique">
                </div>
            </div>
        </div>

        <!-- Professional Cars Section -->
        <div class="professional-cars">
            <div class="container-about">
                <div class="left-content-about">
                    <h3>WE ARE THE BEST</h3>
                    <h1>Trust the <br>professionals for<br>Rent Car</h1>
                    <p>Trust your car rental needs to the professionals. We offer a variety of well-maintained vehicles,
                        ready to take you to your destination comfortably and safely. With our extensive experience, you
                        can enjoy your trip without worry.</p>
                    <div class="buttons-about">
                        <button class="button__about btn-get-started"
                            onclick="window.location.href='{{ route('cars') }}';">Get
                            Started</button>
                        <button class="button__about btn-learn-more"
                            onclick="window.location.href='https://api.whatsapp.com/send?phone=088229877220&text=Hello%20Customer%20Service,%20saya%20butuh%20bantuan.';"
                            target="_blank">Contact Us</button>

                    </div>
                </div>
                <div class="right-content-about">
                    <div class="card-item-unique">
                        <img src="{{ url('frontend/images/car-white.svg') }}" alt="icon" class="card-item-icon-unique">
                        <div class="card-item-text-unique">
                            <h3>Hassle-Free Car Rental</h3>
                            <p>Quick, easy booking with well-maintained cars for your comfort.</p>
                        </div>
                    </div>
                    <div class="card-item-unique">
                        <img src="{{ url('frontend/images/copy-success.svg') }}" alt="icon"
                            class="card-item-icon-unique">
                        <div class="card-item-text-unique">
                            <h3>Trusted Professionals</h3>
                            <p>Enjoy a safe and smooth journey with our expert rental service.</p>
                        </div>
                    </div>
                    <div class="card-item-unique">
                        <img src="{{ url('frontend/images/heart-tick.svg') }}" alt="icon"
                            class="card-item-icon-unique">
                        <div class="card-item-text-unique">
                            <h3>Convenient Rentals</h3>
                            <p>Rent a car easily at attractive prices for any trip. The right choice here</p>
                        </div>
                    </div>
                    <div class="card-item-unique">
                        <img src="{{ url('frontend/images/routing-2.svg') }}" alt="icon" class="card-item-icon-unique">
                        <div class="card-item-text-unique">
                            <h3>Flexible Rental Options</h3>
                            <p>Choose from a variety of vehicles to suit your needs. Find the right one for you</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
