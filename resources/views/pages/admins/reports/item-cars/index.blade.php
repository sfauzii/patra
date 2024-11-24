@extends('layouts.admin')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Report Item Cars</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('reports.order-booking') }}">Item Cars</a></li>
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
                        <form action="{{ route('reports.item-cars') }}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="startDate">Start Date</label>
                                        <input type="date" name="start_date" id="roundText" class="form-control round"
                                            placeholder="Rounded Input" required value="{{ $start_date }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="endDate">End Date</label>
                                        <input type="date" name="end_date" id="squareText" class="form-control square"
                                            placeholder="Square Input" required value="{{ $end_date }}">
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
            <strong>{{ \Carbon\Carbon::parse($start_date)->format('d F Y') }}</strong> sampai
            <strong>{{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</strong> Last Report
        </p>

    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    @if ($items->isNotEmpty())
                        <form action="{{ route('reports.item-cars.download') }}" method="GET" class="no-print">
                            <input type="hidden" name="start_date" value="{{ $start_date }}">
                            <input type="hidden" name="end_date" value="{{ $end_date }}">
                            <button class="btn btn-danger" type="submit" style="margin: 30px 0 30px 10px;">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                            </button>
                        </form>
                    @endif
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Car Name</th>
                            <th>Brand Name</th>
                            <th>Type Name</th>
                            <th>Price</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ ucwords($item->name) }}</td>
                                <td>{{ ucwords($item->brand->name) }}</td>
                                <td>{{ ucwords($item->type->name) }}</td>
                                <td>Rp {{ number_format($item->price, 0, ' ') }}</td>

                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No data available</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    @endsection
