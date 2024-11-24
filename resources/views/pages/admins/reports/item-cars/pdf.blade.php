<!DOCTYPE html>
<html>

    <head>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                font-size: 12px;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .header img {
                width: 100px;
                /* Sesuaikan dengan ukuran yang diinginkan */
            }

            .header h1 {
                margin: 0;
                font-size: 24px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .total {
                margin-top: 20px;
                font-size: 16px;
                font-weight: bold;
                text-align: right;
            }

            .footer {
                margin-top: 30px;
                text-align: right;
                font-size: 14px;
            }
        </style>
    </head>

    <body>
        <div class="header">
            {{-- <img src="{{ asset('backend/assets/img/wawe.png') }}" alt="Logo Perusahaan"> --}}
            <h1>Laporan Item Cars</h1>
        </div>

        <p class="mt-4">Periode: <strong>{{ \Carbon\Carbon::parse($start_date)->format('d F Y') }}</strong> sampai
            <strong>{{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</strong>
        </p>

        <div class="tab-content pt-2" id="borderedTabContent">
            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                @foreach ($items as $item)
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>{{ $loop->iteration }}</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <td>{{ $item->id }}</td>
                        </tr>
                        <tr>
                            <th>Car Name</th>
                            <td>{{ ucwords($item->name) }}</td>
                        </tr>
                        <tr>
                            <th>Car Brand</th>
                            <td>{{ ucwords($item->brand->name) }}</td>
                        </tr>
                        <tr>
                            <th>Car Type</th>
                            <td>{{ ucwords($item->type->name) }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ number_format($item->price, 0, ' ') }}</td>
                        </tr>

                    </table>
                    <div class="mt-5">
                        <hr>
                    </div>
                @endforeach
            </div>
            {{-- <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
            @if ($testimonies->isEmpty())
                <div class="alert alert-info">Tidak ada testimoni.</div>
            @else
                <div class="testimonial-wrapper">
                    @foreach ($testimonies as $testimony)
                        <div class="testimonial-item">
                            <blockquote class="blockquote">
                                <img src="{{ $testimony->user->photo ? asset('storage/' . $testimony->user->photo) : 'https://ui-avatars.com/api/?name=' . $testimony->user->name }}"
                                    alt="User Photo" class="user-photo">
                                <p class="mb-0">{{ $testimony->message }}</p>
                                <footer class="blockquote-footer">{{ $testimony->user->name }}</footer>
                            </blockquote>
                        </div>
                    @endforeach
                </div>
            @endif
        </div> --}}

        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car Name</th>
                    <th>Brand Name</th>
                    <th>Type Name</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>Total Sales (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ ucwords($item->name) }}</td>
                        <td>{{ ucwords($item->brand->name) }}</td>
                        <td>{{ ucwords($item->type->name) }}</td>
                        <td>Rp {{ number_format($item->price, 0, ' ') }}</td>
                        <td>{{ $item->sales }}</td>
                        <td>Rp {{ number_format($item->total_sales_rupiah, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Report By: {{ Auth::user()->name }}
        </div>
    </body>

</html>
