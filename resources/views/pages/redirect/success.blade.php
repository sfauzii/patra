@extends('layouts.app')

@php
    $showFooter = false;
    $showNavbar = false;
@endphp

@section('content')
    <section class="well-dones">
        <div class="container">
            <!-- Logo Image -->
            <div class="logo-wrapper">
                <a href="/"><img src="{{ url('frontend/images/logo-white.svg') }}" alt="Logo" class="logo-well">
                </a>
            </div>

            <!-- Card -->
            <div class="well-card">
                <!-- Icon Image -->
                <div class="icon-wrapper">
                    <img src="{{ url('frontend/images/icon-receipt-item.svg') }}" alt="Icon Image"
                        class="icon-image-card-well">
                </div>

                <!-- Title -->
                <h2 class="title-well">Well Done! Booking {{ ucwords($booking->item->name) }}
                    {{ ucwords(Auth::user()->name) }} Berhasil 🙌</h2>

                <!-- Input Booking Code -->
                <div class="booking-code-input">
                    <img src="{{ url('frontend/images/icon-receipt.svg') }}" alt="Input Icon" class="input-icon-well">
                    <label for="booking-code" class="floating-placeholder">Booking Code:</label>
                    <input type="text" placeholder=" " class="input-field well-done" readonly
                        value="{{ $booking->booking_code }}">
                </div>

                <!-- Description -->
                <p class="description-well">Pesanan Anda berhasil dibuat. Kami sedang melakukan proses verifikasi,
                    mohon
                    menunggu beberapa menit 🎉</p>

                <!-- Button -->
                <!-- Payment Status Buttons -->
                @if ($booking->payment_status === 'success')
                    <!-- Button for successful payment -->
                    <button class="btn-full-width" onclick="window.location.href='check-booking.html';">Lihat
                        Pesananku</button>
                @elseif ($booking->payment_status === 'pending')
                    <!-- Button for pending payment -->
                    <button class="btn-full-width" onclick="window.location.href='{{ $booking->payment_url }}';">Pay
                        Now</button>
                @elseif ($booking->payment_status === 'cancelled')
                    <!-- Button for cancelled payment -->
                    <button class="btn-full-width" onclick="window.location.href='/';">Contact Us</button>
                @endif

            </div>
        </div>
    </section>
@endsection
