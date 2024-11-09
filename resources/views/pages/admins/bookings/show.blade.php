@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Booking {{ ucwords($booking->user->name) }}</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Detail</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-8 col-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4 class="card-title">Horizontal Form</h4>
                        </div> --}}
                        <div class="card-content">
                            <div class="card-body">
                                <div class="information-header mb-8">
                                    <h5 class="mb-4">Booking Information</h5>
                                </div>

                                <form class="form form-horizontal">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Name</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="name" placeholder="Type Name"
                                                    value="{{ $booking->item->name }}" readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">User</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="features" placeholder="Feature" value="{{ $booking->user->name }}"
                                                    readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Number WhatsApp</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="features" placeholder="Feature" value="{{ $booking->phone }}"
                                                    readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Address</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="features" placeholder="Feature" value="{{ $booking->address }}"
                                                    readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Start Date</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="features" placeholder="Feature"
                                                    value="{{ date('d, F Y', strtotime($booking->start_date)) }}" readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">End Date</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="features" placeholder="Feature"
                                                    value="{{ date('d, F Y', strtotime($booking->end_date)) }}" readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Booking Code</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control"
                                                    name="features" placeholder="Feature"
                                                    value="{{ $booking->booking_code }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="card-content">
                                <div class="card-body">
                                    <h5>Booking Information</h5>
                                    <p><strong>Created At:</strong> {{ $booking->created_at->format('d-m-Y H:i:s') }}</p>
                                    <p><strong>Updated At:</strong> {{ $booking->updated_at->format('d-m-Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <h4>Validation Document</h4>
                            </div>
                            <div class="card-body">
                                <p>Click the accordions below to expand/collapse the accordion content.</p>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                KTP Booking
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="col-md-8 form-group">
                                                    <a href="{{ asset('storage/' . $booking->ktp_booking) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $booking->ktp_booking) }}"
                                                            alt="KTP" style="width: auto; height: 200px;">
                                                    </a>
                                                    <div class="pb-2 pt-2">
                                                        Status:
                                                        <strong>{{ strtoupper($booking->documentValidations->where('document_type', 'ktp_booking')->first()->status ?? 'PENDING') }}</strong>
                                                    </div>

                                                    <!-- Display rejection reason if status is REJECTED -->
                                                    @if (strtoupper($booking->documentValidations->where('document_type', 'ktp_booking')->first()->status ?? '') ===
                                                            'REJECTED')
                                                        <div class="text-danger pb-2">
                                                            <strong>Rejection Reason:</strong>
                                                            {{ $booking->documentValidations->where('document_type', 'ktp_booking')->first()->rejection_reason }}
                                                        </div>
                                                    @endif

                                                    <form
                                                        action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="document_type" value="ktp_booking">
                                                        <input type="hidden" name="action" value="approve">
                                                        <button type="submit" class="btn btn-success">Approve</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="showRejectModal('ktp_booking')">
                                                        Reject
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Identity Booking (KK/BPJS)
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="col-md-8 form-group">
                                                    <a href="{{ asset('storage/' . $booking->identity_booking) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $booking->identity_booking) }}"
                                                            alt="IDENTITY" style="width: auto; height: 200px;">
                                                    </a>
                                                    <div class="pb-2 pt-2">
                                                        Status:
                                                        <strong>
                                                            {{ strtoupper($booking->documentValidations->where('document_type', 'identity_booking')->first()->status ?? 'PENDING') }}
                                                        </strong>
                                                    </div>

                                                    <!-- Display rejection reason if status is REJECTED -->
                                                    @if (strtoupper($booking->documentValidations->where('document_type', 'identity_booking')->first()->status ?? '') ===
                                                            'REJECTED')
                                                        <div class="text-danger pb-2">
                                                            <strong>Rejection Reason:</strong>
                                                            {{ $booking->documentValidations->where('document_type', 'identity_booking')->first()->rejection_reason }}
                                                        </div>
                                                    @endif

                                                    <form
                                                        action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="document_type"
                                                            value="identity_booking">
                                                        <input type="hidden" name="action" value="approve">
                                                        <button type="submit" class="btn btn-success">Approve</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="showRejectModal('identity_booking')">
                                                        Reject
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Selfie Booking
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="col-md-8 form-group">
                                                    <a href="{{ asset('storage/' . $booking->selfie_booking) }}"
                                                        target="_blank">
                                                        <img src="{{ asset('storage/' . $booking->selfie_booking) }}"
                                                            alt="KTP" style="width: auto; height: 200px;">
                                                    </a>
                                                    <div class="pb-2 pt-2">
                                                        Status:
                                                        <strong>
                                                            {{ strtoupper($booking->documentValidations->where('document_type', 'selfie_booking')->first()->status ?? 'PENDING') }}
                                                        </strong>
                                                    </div>

                                                    <!-- Display rejection reason if status is REJECTED -->
                                                    @if (strtoupper($booking->documentValidations->where('document_type', 'selfie_booking')->first()->status ?? '') ===
                                                            'REJECTED')
                                                        <div class="text-danger pb-2">
                                                            <strong>Rejection Reason:</strong>
                                                            {{ $booking->documentValidations->where('document_type', 'selfie_booking')->first()->rejection_reason }}
                                                        </div>
                                                    @endif

                                                    <form
                                                        action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="document_type"
                                                            value="selfie_booking">
                                                        <input type="hidden" name="action" value="approve">
                                                        <button type="submit" class="btn btn-success">Approve</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="showRejectModal('selfie_booking')">
                                                        Reject
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function showRejectModal(documentType) {
                                    document.getElementById('reject_document_type').value = documentType;
                                    $('#rejectModal').modal('show');
                                }

                                // Clear form when modal is closed
                                $('#rejectModal').on('hidden.bs.modal', function() {
                                    document.getElementById('rejection_reason').value = '';
                                    document.getElementById('reject_document_type').value = '';
                                });
                            </script>

                            <!-- Reject Modal -->
                            <div class="modal fade text-left" id="rejectModal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Rejection Reason</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form id="rejectForm"
                                            action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input type="hidden" id="reject_document_type" name="document_type"
                                                    value="">
                                                <input type="hidden" name="action" value="reject">
                                                <div class="form-group">
                                                    <label for="rejection_reason">Reason for Rejection</label>
                                                    <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="4" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="submit" class="btn btn-danger ms-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Confirm Rejection</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-body">
                                <div class="information-header mb-8">
                                    <h5 class="mb-4">Validation Document</h5>
                                </div>
                                <div class="col-md-4">
                                    <label for="ktp_booking">KTP</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <a href="{{ asset('storage/' . $booking->ktp_booking) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $booking->ktp_booking) }}" alt="KTP"
                                            style="width: 125px; height: 125px;">
                                    </a>
                                    <div>
                                        <strong>Status:</strong>
                                        {{ strtoupper($booking->documentValidations->where('document_type', 'ktp_booking')->first()->status ?? 'PENDING') }}
                                    </div>
                                    <form action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="document_type" value="ktp_booking">
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-danger"
                                        onclick="showRejectModal('ktp_booking')">
                                        Reject
                                    </button>
                                </div>

                                <div class="col-md-4">
                                    <label for="ktp_booking">Identity</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <a href="{{ asset('storage/' . $booking->identity_booking) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $booking->identity_booking) }}" alt="IDENTITY"
                                            style="width: 125px; height: 125px;">
                                    </a>
                                    <div>
                                        <strong>Status:</strong>
                                        {{ strtoupper($booking->documentValidations->where('document_type', 'identity_booking')->first()->status ?? 'PENDING') }}
                                    </div>
                                    <form action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="document_type" value="identity_booking">
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-danger"
                                        onclick="showRejectModal('identity_booking')">
                                        Reject
                                    </button>
                                </div>

                                <div class="col-md-4">
                                    <label for="ktp_booking">Selfie</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <a href="{{ asset('storage/' . $booking->selfie_booking) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $booking->selfie_booking) }}" alt="KTP"
                                            style="width: 125px; height: 125px;">
                                    </a>
                                    <div>
                                        <strong>Status:</strong>
                                        {{ strtoupper($booking->documentValidations->where('document_type', 'selfie_booking')->first()->status ?? 'PENDING') }}
                                    </div>
                                    <form action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="document_type" value="selfie_booking">
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-danger"
                                        onclick="showRejectModal('selfie_booking')">
                                        Reject
                                    </button>
                                </div>

                                <script>
                                    function showRejectModal(documentType) {
                                        document.getElementById('reject_document_type').value = documentType;
                                        $('#rejectModal').modal('show');
                                    }

                                    // Clear form when modal is closed
                                    $('#rejectModal').on('hidden.bs.modal', function() {
                                        document.getElementById('rejection_reason').value = '';
                                        document.getElementById('reject_document_type').value = '';
                                    });
                                </script>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog"
                                    aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel">Rejection Reason</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="rejectForm"
                                                action="{{ route('bookings.updateDocument', ['booking' => $booking->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" id="reject_document_type" name="document_type"
                                                        value="">
                                                    <input type="hidden" name="action" value="reject">
                                                    <div class="form-group">
                                                        <label for="rejection_reason">Reason for Rejection</label>
                                                        <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="4" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Confirm
                                                        Rejection</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div> --}}
                        </div>
                    </div>
                </div>

                {{--<div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="card-content">
                                <div class="card-body">
                                    <div class="information-header mb-8">
                                        <h5 class="mb-4">Validation Information</h5>
                                    </div>
                                    <!-- KTP Booking Information -->
                                    <p><strong>KTP Booking Created At:</strong>
                                        {{ $booking->documentValidations->where('document_type', 'ktp_booking')->first()->created_at->format('d-m-Y H:i:s') ?? 'N/A' }}
                                    </p>
                                    <p><strong>KTP Booking Updated At:</strong>
                                        {{ $booking->documentValidations->where('document_type', 'ktp_booking')->first()->updated_at->format('d-m-Y H:i:s') ?? 'N/A' }}
                                    </p>

                                    <!-- Identity Booking Information -->
                                    <p><strong>Identity Booking Created At:</strong>
                                        {{ $booking->documentValidations->where('document_type', 'identity_booking')->first()->created_at->format('d-m-Y H:i:s') ?? 'N/A' }}
                                    </p>
                                    <p><strong>Identity Booking Updated At:</strong>
                                        {{ $booking->documentValidations->where('document_type', 'identity_booking')->first()->updated_at->format('d-m-Y H:i:s') ?? 'N/A' }}
                                    </p>

                                    <!-- Selfie Booking Information -->
                                    <p><strong>Selfie Booking Created At:</strong>
                                        {{ $booking->documentValidations->where('document_type', 'selfie_booking')->first()->created_at->format('d-m-Y H:i:s') ?? 'N/A' }}
                                    </p>
                                    <p><strong>Selfie Booking Updated At:</strong>
                                        {{ $booking->documentValidations->where('document_type', 'selfie_booking')->first()->updated_at->format('d-m-Y H:i:s') ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}

        </section>
    @endsection

   