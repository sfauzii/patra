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
