<div>
    <div class="booking-card">
        <form wire:submit.prevent="checkBooking" class="booking-form">
            <div class="form-group check-bookings">
                <label for="input-field">Booking TRX ID</label>
                <div class="input-container check-bookings">
                    <img src="frontend/images/icon-receipt-form.svg" alt="Icon" class="input-icon check-bookings">
                    <input type="text" wire:model="booking_code" id="input-field" placeholder="Enter Booking Code" class="form-input @error('booking_code') {{ $message }} @enderror">
                    @error('booking_code') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group check-bookings">
                <label for="input-field">WhatsApp Number</label>
                <div class="input-container check-bookings">
                    <img src="frontend/images/icon-whatsapp.svg" alt="Icon" class="input-icon check-bookings">
                    <input type="text" wire:model="phone" id="input-field" placeholder="Enter WhatsApp Number" class="form-input">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group check-bookings">
                <button type="submit" class="check-button">Check</button>
            </div>
        </form>

        @if (session()->has('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
    </div>
</div>
