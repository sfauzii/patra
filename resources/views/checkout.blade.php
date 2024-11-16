@extends('layouts.app')

@php
    $showFooter = false;
@endphp



@section('content')
    <section class="details">
        <!-- Section Heading with Background Image -->
        <div class="details-background"></div>

        <!-- Content Section -->
        <div class="details-content">
            <div class="heading-content">
                <h1>Start Booking Your Car</h1>
                <h3>Home > Car Details > Start Booking</h3>
            </div>

            @livewire('checkout', ['item' => $item])
            <!-- Two Column Content Section -->
            {{-- <div class="content-columns">
                <!-- Left Column -->
                <div class="column-left">
                    <div class="card-form-booking">
                        <div class="card-header">
                            <img src="{{ url('frontend/images/civic.jpg') }}" alt="Image" class="booking-image">
                            <div class="title-badge">
                                <h3>{{ ucwords($item->name) }} </h3>
                                <span class="badge-category">{{ ucwords($item->type->name) }}</span>
                            </div>
                        </div>
                        <hr class="hr-booking">

                        <h4 class="details-title">Complete the details</h4>
                        <form action="">
                            <div class="form-group">
                                <label for="input-field">Name</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-profile-circle.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="text" name="name" id="input-field" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="input-field">WhatsApp Number</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-whatsapp.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="text" name="phone" id="input-field" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="input-field">Address</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-location.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="text" name="address" id="input-field" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="start-date">Start Date</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-calendar-2.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="date" name="start_date" id="start-date" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <label for="until-date">Until Date</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-calendar-2.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="date" name="end_date" id="until-date" placeholder="Placeholder Text"
                                        class="form-input">
                                </div>
                                <div class="icon-information">
                                    <img src="{{ url('frontend/images/icon-shield-tick.svg') }}" alt="Info Icon"
                                        class="info-icon">
                                    <p>Kami akan melindungi privasi Anda sebaik mungkin
                                        sehingga dapat melanjutkan proses upload dokumen!</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file-upload">Upload KTP</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="file" name="ktp_booking" id="file-upload" class="form-input">
                                </div>
                                <label for="file-upload">Upload Identitas Lainnya (KK/BPJS)</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="file" name="identity_booking" id="file-upload" class="form-input">
                                </div>
                                <label for="file-upload">Upload Photo Selfie</label>
                                <div class="input-container">
                                    <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                                        class="input-icon">
                                    <input type="file" name="selfie_booking" id="file-upload" class="form-input">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="column-right">
                    <div class="car-informations booking-right" id="scrolling-card">

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
                            <div class="detail-item payment-service">
                                <div class="tooltip-wrapper">
                                    <h3>Payment Service</h3>
                                    <span class="tooltip-icon">?</span>
                                    <div class="tooltip-text">Biaya untuk fee payment gateway dan platform service
                                        lainnya!</div>
                                </div>
                                <p>+Rp 10,000</p>
                            </div>
                            <!-- <hr> -->
                            <div class="detail-item grand-total">
                                <h3>Grand Total</h3>
                                <p>Rp 1,000,000</p>
                            </div>

                            <!-- Add radio button with text -->
                            <div class="detail-item terms-condition">
                                <input type="radio" name="terms" value="agree">
                                <p>Saya setuju dengan <a href="#">Terms & Condition</a></p>
                            </div>
                        </div>
                        <button class="btn-book" onclick="window.location.href='well-dones.html';">Proceed to
                            Payment</button>
                    </div>
                </div>
            </div> --}}


            <!-- Modal -->
            <div id="imageModal" class="modal">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="modalImage">
            </div>




        </div>
    </section>

    <!-- Footer -->
    <x-footer-alternate />
@endsection
