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

                    <h4 class="details-title">You have completed the details</h4>
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

                            @if ($documentStatus)
                                @php
                                    $statusText = match ($documentStatus['status']) {
                                        'APPROVED'
                                            => 'Your documents have been approved and all your documents are safe with us.',
                                        'WAITING' => 'Your documents are waiting for approval.',
                                        'REJECTED' => 'Some documents were rejected. Please upload them again.',
                                        'INCOMPLETE'
                                            => 'Your documents are incomplete. Please complete them.', // default => 'Your privacy is safe with us.',
                                    };
                                @endphp

                                <p>{{ $statusText }}</p>

                                @php
                                    $statusColor = match ($documentStatus['status']) {
                                        'APPROVED' => 'background-color: #28a745;', // Green
                                        'WAITING' => 'background-color: #FF9500;', // Orange
                                        'REJECTED' => 'background-color: #dc3545;', // Red
                                        'INCOMPLETE' => 'background-color: #6c757d;', // Gray
                                        default => 'background-color: #6c757d;',
                                    };
                                @endphp
                            @else
                                <p class="text-gray-500">No document status available</p>
                            @endif
                        </div>


                        <!-- Document Upload Section -->
                        @if (!empty($rejectedDocuments))
                            <hr class="hr-booking">

                            <div class="mt-6">
                                <h4 class="details-title mb-lg-4">Required Document Re-upload</h4>

                                @foreach ($rejectedDocuments as $docType => $rejectionReason)
                                    <div class="mb-6 document-upload-section">
                                        {{-- <label for="{{ $docType }}" class="block mb-2">
                                            {{ ucwords(str_replace('_', ' ', $docType)) }}
                                            <span class="text-red-500 text-sm">
                                                (Rejected: {{ $rejectionReason }})
                                            </span>
                                        </label> --}}

                                        <div class="tooltip-wrapper">
                                            <h6 class="block mb-2">{{ ucwords(str_replace('_', ' ', $docType)) }}</h6>
                                            <span class="tooltip-icon mb-2">?</span>
                                            <div class="tooltip-text">{{ $rejectionReason }}</div>
                                        </div>

                                        <div class="input-container">
                                            <img src="{{ asset('frontend/images/icon-gallery-export.svg') }}"
                                                alt="Upload Icon" class="input-icon">
                                            <input type="file"
                                                wire:model="{{ str_replace('_booking', '', $docType) }}Booking"
                                                id="{{ $docType }}" class="form-input" accept="image/*">
                                        </div>

                                        <div wire:loading
                                            wire:target="{{ str_replace('_booking', '', $docType) }}Booking"
                                            class="text-sm text-blue-600 mt-1">
                                            Uploading...
                                        </div>

                                        @error(str_replace('_booking', '', $docType) . 'Booking')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach

                                <button wire:click="uploadDocuments" wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50 cursor-not-allowed" class="btn-book w-full">
                                    <span wire:loading.remove wire:target="uploadDocuments">
                                        Upload Documents
                                    </span>
                                    <span wire:loading wire:target="uploadDocuments">
                                        Processing...
                                    </span>
                                </button>
                            </div>
                        @endif
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
                            <div class="tooltip-wrapper">
                                <h3>Document Status</h3>
                                <span class="tooltip-icon">?</span>
                                <div class="tooltip-text">
                                    <!-- Optional: Display detailed information -->
                                    <div class="ml-3 mt-2 text-sm">
                                        <p>{{ $documentStatus['details']['approved_count'] }} of
                                            {{ $documentStatus['details']['total_documents'] }} documents approved</p>

                                        @if (!empty($documentStatus['details']['rejected_documents']))
                                            <p class="text-red-500">
                                                Rejected documents:
                                                {{ implode(', ', array_map(fn($doc) => ucfirst(str_replace('_booking', '', $doc)), $documentStatus['details']['rejected_documents'])) }}
                                            </p>
                                        @endif

                                        @if (!empty($documentStatus['details']['waiting_documents']))
                                            <p class="text-orange-500">
                                                Waiting documents:
                                                {{ implode(', ', array_map(fn($doc) => ucfirst(str_replace('_booking', '', $doc)), $documentStatus['details']['waiting_documents'])) }}
                                            </p>
                                        @endif

                                        @if (!empty($documentStatus['details']['missing_documents']))
                                            <p class="text-gray-500">
                                                Missing documents:
                                                {{ implode(', ', array_map(fn($doc) => ucfirst(str_replace('_booking', '', $doc)), $documentStatus['details']['missing_documents'])) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($documentStatus)
                                @php
                                    $statusColor = match ($documentStatus['status']) {
                                        'APPROVED' => 'background-color: #28a745;', // Green
                                        'WAITING' => 'background-color: #FF9500;', // Orange
                                        'REJECTED' => 'background-color: #dc3545;', // Red
                                        'INCOMPLETE' => 'background-color: #6c757d;', // Gray
                                        default => 'background-color: #6c757d;',
                                    };
                                @endphp
                                <p
                                    style="{{ $statusColor }} color: #fff; padding: 8px 12px; border-radius: 20px; display: inline-block; width: auto;">
                                    {{ $documentStatus['status'] }}
                                </p>
                            @else
                                <p class="text-gray-500">No document status available</p>
                            @endif
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
