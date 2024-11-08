<div>
    @if ($bookingDetails)
        <div class="content-columns mt-4">
            <!-- Left Column -->
            <div class="column-left check-bookings">
                <div class="card-form-booking">
                    <div class="card-header">
                        <img src="{{ isset($bookingDetails['item']['photos']) ? asset('storage/' . json_decode($bookingDetails['item']['photos'])[0]) : asset('frontend/images/default.jpg') }}"
                            alt="{{ $bookingDetails['item']['name'] ?? 'Item Image' }}" class="booking-image">
                        <div class="title-badge">
                            <h3>{{ ucwords($bookingDetails['item']['name'] ?? 'Item Name') }}</h3>
                            <span
                                class="badge-category">{{ ucwords($bookingDetails['item']['type']['name'] ?? 'Type Name') }}</span>
                        </div>
                    </div>
                    <hr class="hr-booking">

                    <h4 class="details-title">Complete the details</h4>
                    <div class="form-group check-bookings">
                        <label for="input-field">Name</label>
                        <div class="input-container">
                            <img src="frontend/images/icon-profile-circle.svg" alt="Icon" class="input-icon">
                            <input type="text" id="input-field" class="form-input"
                                value="{{ $bookingDetails['name'] }}" readonly>
                        </div>
                        <label for="input-field">WhatsApp Number</label>
                        <div class="input-container">
                            <img src="frontend/images/icon-whatsapp.svg" alt="Icon" class="input-icon">
                            <input type="text" id="input-field" class="form-input"
                                value="{{ $bookingDetails['phone'] }}" readonly>
                        </div>
                        <label for="input-field">Address</label>
                        <div class="input-container">
                            <img src="frontend/images/icon-location.svg" alt="Icon" class="input-icon">
                            <input type="text" id="input-field" class="form-input"
                                value="{{ $bookingDetails['address'] }}" readonly>
                        </div>
                        <label for="start-date">Start Date</label>
                        <div class="input-container">
                            <img src="frontend/images/icon-calendar-2.svg" alt="Icon" class="input-icon">
                            <input type="date" id="start-date" class="form-input"
                                value="{{ $bookingDetails['start_date'] }}" readonly>
                        </div>
                        <label for="until-date">Until Date</label>
                        <div class="input-container">
                            <img src="frontend/images/icon-calendar-2.svg" alt="Icon" class="input-icon">
                            <input type="date" id="until-date" class="form-input"
                                value="{{ $bookingDetails['end_date'] }}" readonly>
                        </div>
                        <div class="icon-information">
                            <img src="frontend/images/icon-shield-tick.svg" alt="Info Icon" class="info-icon">
                            <p>Your privacy is safe with us</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="column-right check-bookings">
                <div class="car-informations">
                    <h3>Your Order Details</h3>
                    <div class="booking-details">
                        <div class="detail-item">
                            <h3>Status Pembayaran</h3>
                            @php
                                $status = strtoupper($bookingDetails['payment_status']);
                                $bgColor = match ($status) {
                                    'SUCCESS' => 'background-color: #28a745;', // Green
                                    'PENDING' => 'background-color: #FF9500;', // Orange
                                    'FAILED', 'CANCELLED' => 'background-color: #dc3545;', // Red
                                    default => 'background-color: #6c757d;', // Default Gray for other statuses
                                };
                            @endphp
                            <p
                                style="{{ $bgColor }} color: #fff; padding: 8px 12px; border-radius: 20px; display: inline-block; width: auto;">
                                {{ $status }}
                            </p>
                        </div>
                        <div class="detail-item">
                            <h3>Duration</h3>
                            <p>{{ $duration }} days</p>
                        </div>

                        <div class="detail-item grand-total">
                            <h3>Grand Total</h3>
                            <p>Rp {{ number_format($bookingDetails['total_price'], 0, ',', '.') }}</p>
                        </div>
                        <hr>
                    </div>
                    <button class="btn-book" onclick="window.location.href='well-dones.html';">Review</button>
                    <button class="btn-call-customer" onclick="window.location.href='well-dones.html';">Call Customer
                        Service</button>
                </div>
            </div>
        </div>
    @endif

</div>
