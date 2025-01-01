<div class="content-columns">
    <!-- Left Column -->
    <div class="column-left">
        <div class="card-form-booking">
            <div class="card-header">
                <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}" alt="Image" class="booking-image">
                <div class="title-badge">
                    <h3>{{ ucwords($item->name) }} </h3>
                    <span class="badge-category">{{ ucwords($item->type->name) }}</span>
                </div>
            </div>
            <hr class="hr-booking">


            <h4 class="details-title">Complete the details</h4>
            <form wire:submit.prevent="processPayment" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="input-field">Name</label>
                    <div class="input-container">
                        <img src="{{ url('frontend/images/icon-profile-circle.svg') }}" alt="Icon"
                            class="input-icon">
                        <input type="text" wire:model="name" id="input-field" placeholder="Placeholder Text"
                            class="form-input" readonly disabled style="opacity: 0.6; cursor: not-allowed;">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <label for="input-field">WhatsApp Number</label>
                    <div class="input-container">
                        <img src="{{ url('frontend/images/icon-whatsapp.svg') }}" alt="Icon" class="input-icon">
                        <input type="number" wire:model="phone" id="input-field" placeholder="Placeholder Text"
                            class="form-input" min="0">
                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="detail-item payment-service">
                        <div class="tooltip-wrapper">
                            <h3 style="font-size: 16px; color: #333;">Address</h3>
                            <span class="tooltip-icon">i</span>
                            <div class="tooltip-text">Pastikan alamat yang Anda masukkan sesuai dengan identitas Anda!
                            </div>
                        </div>
                    </div>
                    <div class="input-container">

                        <img src="{{ url('frontend/images/icon-location.svg') }}" alt="Icon" class="input-icon">
                        <input type="text" wire:model="address" id="input-field" placeholder="Placeholder Text"
                            class="form-input">


                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <label for="start-date">Start Date</label>
                    <div class="input-container">
                        <img src="{{ url('frontend/images/icon-calendar-2.svg') }}" alt="Icon" class="input-icon">
                        <input type="date" wire:model.live="startDate" id="start-date" placeholder="Start Date"
                            class="form-input" min="{{ now()->toDateString() }}">
                        @error('startDate')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <label for="until-date">Until Date</label>
                    <div class="input-container">
                        <img src="{{ url('frontend/images/icon-calendar-2.svg') }}" alt="Icon" class="input-icon">
                        <input type="date" wire:model.live="endDate" id="until-date" placeholder="End Date"
                            class="form-input" min="{{ $startDate ?? now()->toDateString() }}">
                        @error('endDate')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="icon-information">
                        <img src="{{ url('frontend/images/icon-shield-tick.svg') }}" alt="Info Icon" class="info-icon">
                        <p>Kami akan melindungi privasi Anda sebaik mungkin
                            sehingga dapat melanjutkan proses upload dokumen!</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="file-upload">Upload KTP</label>
                    <div class="input-container">
                        <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                            class="input-icon">
                        <input type="file" wire:model="ktpBooking" id="file-upload" class="form-input">
                        @error('ktpBooking')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <label for="file-upload">Upload Identitas Lainnya (KK/BPJS)</label>
                    <div class="input-container">
                        <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                            class="input-icon">
                        <input type="file" wire:model="identityBooking" id="file-upload" class="form-input">
                        @error('identityBooking')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                    <label for="file-upload">Upload Photo Selfie</label>
                    <div class="input-container">
                        <img src="{{ url('frontend/images/icon-gallery-export.svg') }}" alt="Icon"
                            class="input-icon">
                        <input type="file" wire:model="selfieBooking" id="file-upload" class="form-input">
                        @error('selfieBooking')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
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
                    <p>Rp {{ number_format($item->price, 0, ' ') }}/day</p>
                </div>
                <div class="detail-item">
                    <h3>Duration</h3>
                    <p>
                        @if ($startDate && $endDate)
                            {{ \Carbon\Carbon::parse($startDate)->diffInDays($endDate) + 1 }} day(s)
                        @else
                            -
                        @endif
                    </p>
                </div>
                <div class="detail-item">
                    <h3>Sub Total</h3>
                    <p>Rp {{ number_format($subTotal, 0, ' ') }}</p>
                </div>
                <div class="detail-item unique-code">
                    <h3>Unique Code</h3>
                    <p>-Rp {{ number_format($uniqueCode, 0, ' ') }}</p>
                </div>
                <div class="detail-item payment-service">
                    <div class="tooltip-wrapper">
                        <h3>Payment Service</h3>
                        <span class="tooltip-icon">?</span>
                        <div class="tooltip-text">Biaya untuk fee payment gateway dan platform service
                            lainnya!</div>
                    </div>
                    <p>+Rp {{ number_format($paymentService, 0, ' ') }}</p>
                </div>
                <!-- <hr> -->
                <div class="detail-item grand-total">
                    <h3>Grand Total</h3>
                    <p>Rp {{ number_format($grandTotal, 0, ' ') }}</p>
                </div>

                <!-- Add radio button with text -->
                <div class="detail-item terms-condition">
                    <input type="radio" name="terms" value="1" wire:model="terms">
                    <p>Saya setuju dengan <a id="terms-btn" href="#">Terms & Condition</a></p>
                </div>

                {{-- @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif --}}
            </div>
            <button type="submit" class="btn-book" wire:loading.attr="disabled" wire:loading.class="loading"><span
                    wire:loading.remove>Proceed to Payment</span>
                <span wire:loading>Loading...</span></button>
        </div>
        </form>

    </div>
</div>
