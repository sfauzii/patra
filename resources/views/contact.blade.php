@extends('layouts.app')

@php
    $showFooter = false;
@endphp

@section('content')
    <section class="contact-us">

        <!-- Title and Description -->
        <div class="title-container contact">
            <h4 class="sub-title contact">Contact Us</h4>
            <h1>Get in touch with us</h1>
            <p class="description contact">We’re here to assist with your car rental needs.</p>
        </div>


        <!-- Google Maps Iframe -->
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63305.747583945726!2d109.20915013591537!3d-7.397607689588339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655fa48add3e9b%3A0x6719bc889b9b1458!2sPATRA%20Rental%20Mobil%20%26%20Motor%20Purwokerto!5e0!3m2!1sid!2sid!4v1728910690790!5m2!1sid!2sid"
                allowfullscreen loading="lazy">
            </iframe>
        </div>

    </section>

    <section class="contact-us-content">
        <div class="card contact">
            <div class="icon-wrapper contact">
                <img src="{{ url('frontend/images/icon-sms.svg') }}" alt="Icon 1">
            </div>
            <div class="content contact">
                <h3>Chat with Us</h3>
                <p>We are here to help!
                </p>
                <a href="https://gmail.com" target="_blank" class="button-contact">patra@rental.com</a>
            </div>
        </div>
        <div class="card contact">
            <div class="icon-wrapper contact">
                <img src="{{ url('frontend/images/icon-location-black.svg') }}" alt="Icon 2">
            </div>
            <div class="content contact">
                <h3>Visit us</h3>
                <p>Visit our office</p>
                <a href="https://maps.app.goo.gl/cVEqjtEJ8YNPzatR6" target="_blank" class="button-contact">View on Google
                    Maps</a>
            </div>
        </div>
        <div class="card contact">
            <div class="icon-wrapper contact">
                <img src="{{ url('frontend/images/icon-whatsapp-black.svg') }}" alt="Icon 3">
            </div>
            <div class="content contact">
                <h3>Call us</h3>
                <p>Open 24/7</p>
                <a href="https://wa.me/6282133337837?text=Halo%20kak%2C%20saya%20boleh%20minta%20daftar%20price%20listnya%3F"
                    class="button-contact" target="_blank">+62 8213 3337 837</a>
            </div>
        </div>
    </section>

    <section class="contact-us-bg">
        <div>
            <img src="frontend/images/logo-white.svg" alt="Footer Logo" class="footer-logo">
        </div>
        <!-- Title and Description -->
        <div class="title-container contus">
            <h1 class="title-contus">Ready to Hit the Road?</h1>
            <p class="description contus">We make car rentals easy and hassle-free.</p>
        </div>

        <!-- Buttons Section -->
        <div class="buttons-container">
            <button class="button__contact  btn-get-started" onclick="window.location.href='{{ route('cars') }}';">Get
                Started</button>
            <button class="button__contact btn-create" onclick="window.location.href='{{ route('register') }}';">Create
                account</button>
        </div>

    </section>

    <x-footer-alternate />
@endsection
