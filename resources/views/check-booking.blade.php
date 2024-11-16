@extends('layouts.app')

@php
    $showFooter = false;
@endphp

@section('content')
    <section class="details">
        <!-- Section Heading with Background Image -->
        <div class="details-background check-bookings"></div>

        <!-- Content Section -->
        <div class="details-content">
            <div class="heading-content">
                <h1>View Your Booking Details</h1>
                <!-- <h3>Home > Car Details > Start Booking</h3> -->
            </div>

            <livewire:check-booking-form />

            {{-- <div class="booking-card">
                <form class="booking-form">
                    <div class="form-group check-bookings">
                        <label for="input-field">Booking TRX ID</label>
                        <div class="input-container check-bookings">
                            <img src="frontend/images/icon-receipt-form.svg" alt="Icon"
                                class="input-icon check-bookings">
                            <input type="text" id="input-field" placeholder="Placeholder Text" class="form-input">
                        </div>
                    </div>

                    <div class="form-group check-bookings">
                        <label for="input-field">WhatsApp Number</label>
                        <div class="input-container check-bookings">
                            <img src="frontend/images/icon-whatsapp.svg" alt="Icon" class="input-icon check-bookings">
                            <input type="text" id="input-field" placeholder="Placeholder Text" class="form-input">
                        </div>
                    </div>

                    <div class="form-group check-bookings">
                        <button type="submit" class="check-button">Check</button>
                    </div>
                </form>
            </div> --}}

            <!-- Two Column Content Section -->
            <livewire:check-booking-details />

            {{-- <div class="content-columns">
                <!-- Left Column -->
                <div class="column-left check-bookings">
                    <div class="card-form-booking">
                        <div class="card-header">
                            <img src="frontend/images/civic.jpg" alt="Image" class="booking-image">
                            <div class="title-badge">
                                <h3>Grand New Avanza </h3>
                                <span class="badge-category">Badge</span>
                            </div>
                        </div>
                        <hr class="hr-booking">

                        <h4 class="details-title">Complete the details</h4>
                        <form>
                            <div class="form-group check-bookings">
                                <label for="input-field">Name</label>
                                <div class="input-container">
                                    <img src="frontend/images/icon-profile-circle.svg" alt="Icon" class="input-icon">
                                    <input type="text" id="input-field" placeholder="Placeholder Text" class="form-input"
                                        value="S Fauzi" readonly>
                                </div>
                                <label for="input-field">WhatsApp Number</label>
                                <div class="input-container">
                                    <img src="frontend/images/icon-whatsapp.svg" alt="Icon" class="input-icon">
                                    <input type="text" id="input-field" placeholder="Placeholder Text" class="form-input"
                                        value="088229877220" readonly>
                                </div>
                                <label for="input-field">Address</label>
                                <div class="input-container">
                                    <img src="frontend/images/icon-location.svg" alt="Icon" class="input-icon">
                                    <input type="text" id="input-field" placeholder="Placeholder Text" class="form-input"
                                        value="Jl. Buah Batu 15" readonly>
                                </div>
                                <label for="start-date">Start Date</label>
                                <div class="input-container">
                                    <img src="frontend/images/icon-calendar-2.svg" alt="Icon" class="input-icon">
                                    <input type="date" id="start-date" placeholder="Placeholder Text" class="form-input"
                                        value="2024-10-01" readonly>
                                </div>
                                <label for="until-date">Until Date</label>
                                <div class="input-container">
                                    <img src="frontend/images/icon-calendar-2.svg" alt="Icon" class="input-icon">
                                    <input type="date" id="until-date" placeholder="Placeholder Text" class="form-input"
                                        value="2024-10-07" readonly>
                                </div>
                                <div class="icon-information">
                                    <img src="frontend/images/icon-shield-tick.svg" alt="Info Icon" class="info-icon">
                                    <p>Privasi Anda aman bersama kami</p>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <!-- Right Column -->
                <div class="column-right check-bookings">
                    <div class="car-informations">

                        <h3>Your Order Details</h3>
                        <!-- Booking Details List -->
                        <div class="booking-details">


                            <div class="detail-item">
                                <h3>Booking Price</h3>
                                <p>Rp 450,00/day</p>
                            </div>
                            <div class="detail-item">
                                <h3>Duration</h3>
                                <p>4 day</p>
                            </div>
                            <div class="detail-item">
                                <h3>Sub Total</h3>
                                <p>Rp 1,000,000</p>
                            </div>
                            <div class="detail-item unique-code">
                                <h3>Unique Code</h3>
                                <p>-Rp 289</p>
                            </div>

                            <!-- <hr> -->
                            <div class="detail-item grand-total">
                                <h3>Grand Total</h3>
                                <p>Rp 1,000,000</p>
                            </div>
                            <hr>



                        </div>
                        <button class="btn-book" onclick="window.location.href='well-dones.html';">Review</button>
                        <button class="btn-call-customer" onclick="window.location.href='well-dones.html';">Call
                            Customer Service</button>
                    </div>
                </div>
            </div> --}}

        </div>
    </section>

    <!-- Footer -->
    <x-footer-alternate />
@endsection
