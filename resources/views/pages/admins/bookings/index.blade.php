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
        {{-- <a href="{{ route('brands.create') }}" class="btn btn-primary" style="margin-bottom: 20px; margin-left: 890px;">New
            Brand</a> --}}
        <div class="card">
            <div class="card-header">
                {{-- <h5 class="card-title">
                        {{~~ jQuery Datatable ~~}}
                    </h5> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Brand</th>
                                <th>Item</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Payment Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->item->brand->name }}</td>
                                    <td>{{ $booking->item->type->name }}</td>
                                    <td>{{ $booking->start_date }}</td>
                                    <td>{{ $booking->end_date }}</td>
                                    <td>{{ $booking->payment_status }}</td>
                                    <td>{{ $booking->total_price }}</td>
                                    
                                    <td>
                                        <div class="buttons">
                                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn icon btn-primary"><i
                                                    class="bi bi-pencil"></i></a>

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
        </div>

    </section>
@endsection
