@extends('layouts.admin')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Bookings</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Bookings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>



    <section class="section">
        <div class="card">
            <div class="card-header">
                {{-- <h5 class="card-title">
                    Simple Datatable
                </h5> --}}
            </div>


            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>Car</th>
                            <th>Brand</th>
                            <th>User</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Duration</th>
                            <th>Payment Status</th>
                            <th>Document Status</th>
                            <th>Return Status</th>
                            <th>Total</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_code }}</td>
                                <td>{{ ucwords($booking->item->name) }}</td>
                                <td>{{ ucwords($booking->item->brand->name) }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ date('d, F Y', strtotime($booking->start_date)) }}</td>
                                <td>{{ date('d, F Y', strtotime($booking->end_date)) }}</td>
                                <td>{{ $booking->duration }} days</td>
                                <td>
                                    @if ($booking->payment_status == 'success')
                                        <span class="badge bg-success">{{ $booking->payment_status }}</span>
                                    @elseif($booking->payment_status == 'pending')
                                        <span class="badge bg-warning">{{ $booking->payment_status }}</span>
                                    @elseif($booking->payment_status == 'failed' || $booking->payment_status == 'expired')
                                        <span class="badge bg-danger">{{ $booking->payment_status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($booking->document_status == 'Pending' || $booking->document_status == 'WAITING')
                                        <span class="badge bg-warning">{{ $booking->document_status }}</span>
                                    @elseif($booking->document_status == 'Approved')
                                        <span class="badge bg-success">{{ $booking->document_status }}</span>
                                    @elseif($booking->document_status == 'Rejected')
                                        <span class="badge bg-danger">{{ $booking->document_status }}</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $booking->return_status }}
                                </td>
                                <td>Rp {{ number_format($booking->total_price, 0, ' ') }}</td>

                                <td>
                                    <div class="buttons">
                                        <a href="{{ route('bookings.show', $booking->id) }}"
                                            class="btn icon btn-success"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('bookings.edit', $booking->id) }}"
                                            class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>

                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn icon btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this brand?')">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
