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

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">KTP</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <a href="{{ asset('storage/' . $booking->ktp_booking) }}"
                                                    target="_blank"><img
                                                        src="{{ asset('storage/' . $booking->ktp_booking) }}" alt=""
                                                        style="width: 125px; height: 125px; "></a>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Identitas Lainnya</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <a href="{{ asset('storage/' . $booking->identity_booking) }}"
                                                    target="_blank"><img
                                                        src="{{ asset('storage/' . $booking->identity_booking) }}"
                                                        alt="" style="width: 125px; height: 125px; "></a>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Foto Selfie</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <a href="{{ asset('storage/' . $booking->selfie_booking) }}"
                                                    target="_blank"><img
                                                        src="{{ asset('storage/' . $booking->selfie_booking) }}"
                                                        alt="" style="width: 125px; height: 125px; "></a>
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
                                    <p><strong>Created At:</strong> {{ $booking->created_at->format('d-m-Y H:i:s') }}</p>
                                    <p><strong>Updated At:</strong> {{ $booking->updated_at->format('d-m-Y H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endsection
