@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Report Order Booking</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('reports.order-booking') }}">Order Booking</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('reports.order-booking') }}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="startDate">Start Date</label>
                                        <input type="date" name="start_date" id="roundText" class="form-control round"
                                            placeholder="Rounded Input" required value="{{ $startDate }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="endDate">End Date</label>
                                        <input type="date" name="end_date" id="squareText" class="form-control square"
                                            placeholder="Square Input" required value="{{ $endDate }}">
                                    </div>
                                </div>

                                <!-- Button with same alignment as form groups -->
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="col-12">
        <p class="mt-4">Periode:
            <strong>{{ \Carbon\Carbon::parse($startDate)->format('d F Y') }}</strong> sampai
            <strong>{{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</strong> Last Report
        </p>

    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    @if ($orders->isNotEmpty())
                        <form action="{{ route('reports.order-booking.download') }}" method="GET" class="no-print">
                            <input type="hidden" name="start_date" value="{{ $startDate }}">
                            <input type="hidden" name="end_date" value="{{ $endDate }}">
                            <button class="btn btn-danger" type="submit" style="margin: 30px 0 30px 10px;">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                            </button>
                        </form>
                    @endif
                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Car</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->booking_code }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F , H:i') }} WIB</td>
                                <td>{{ ucwords($order->item->name) }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, '') }}</td>
                                <td>
                                    @if ($order->payment_status === 'success')
                                        <span
                                            class="badge rounded-pill text-bg-success">{{ $order->payment_status }}</span>
                                    @elseif($order->payment_status === 'IN_CART')
                                        <span class="badge rounded-pill text-bg-primary">
                                            {{ $transaction->payment_status }}</span>
                                    @elseif($order->payment_status === 'pending')
                                        <span
                                            class="badge rounded-pill text-bg-warning">{{ $order->payment_status }}</span>
                                    @elseif($order->payment_status === 'cancelled')
                                        <span
                                            class="badge rounded-pill text-bg-secondary">{{ $order->payment_status }}</span>
                                    @elseif($order->payment_status === 'cancelled')
                                        <span class="badge rounded-pill text-bg-danger">{{ $order->payment_status }}</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-dark">{{ $order->payment_status }}</span>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
