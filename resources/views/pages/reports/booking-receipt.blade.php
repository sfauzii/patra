<!-- resources/views/pdf/booking-receipt.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Booking Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 24px;
        }

        .header p {
            color: #7f8c8d;
            margin: 5px 0;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            background-color: #2c3e50;
            color: white;
            padding: 8px 15px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .booking-info table,
        .user-info table,
        .document-status table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .booking-info td,
        .user-info td,
        .document-status td {
            padding: 10px;
            border: 1px solid #e0e0e0;
            font-size: 12px;
        }

        .booking-info td:first-child,
        .user-info td:first-child,
        .document-status td:first-child {
            font-weight: bold;
            width: 200px;
            background-color: #f8f9fa;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }

        .qr-code {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>BOOKING RECEIPT</h1>
        <p>Generated on: {{ $generated_at }}</p>
        <p style="color: #2c3e50;">Booking Code: <strong>{{ $booking['booking_code'] }}</strong></p>
    </div>

    <div class="section">
        <div class="section-title">USER INFORMATION</div>
        <div class="user-info">
            <table>
                <tr>
                    <td>Full Name</td>
                    <td>{{ ucwords($booking['user']['name']) }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $booking['user']['email'] }}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{ $booking['phone'] ?? '-' }}</td>
                </tr>

            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">BOOKING DETAILS</div>
        <div class="booking-info">
            <table>
                <tr>
                    <td>Item</td>
                    <td>{{ ucwords($booking['item']['name']) }}</td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>{{ ucwords($booking['item']['type']['name']) }}</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>{{ \Carbon\Carbon::parse($booking['start_date'])->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{ \Carbon\Carbon::parse($booking['end_date'])->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ ucfirst($booking['address'] ?? '-') }}</td>
                </tr>
                <tr>
                    <td>Duration</td>
                    <td>{{ $duration }} days</td>
                </tr>
                <tr>
                    <td>Issue</td>
                    <td>{{ \Carbon\Carbon::parse($booking['created_at'])->format('d F Y H:i:s') }}</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td><strong>Rp {{ number_format($booking['total_price'], 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td>Payment Status</td>
                    <td>
                        <span
                            class="status-badge {{ $booking['payment_status'] === 'SUCCESS' ? 'status-success' : 'status-pending' }}">
                            {{ $booking['payment_status'] }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">DOCUMENT VALIDATION STATUS</div>
        <div class="document-status">
            <table>
                <tr>
                    <td>KTP Document</td>
                    <td>
                        @php
                        $ktpStatus = \App\Models\DocumentValidation::where('booking_id', $booking['id'])
                        ->where('document_type', 'ktp_booking')
                        ->first();
                        @endphp
                        <span class="status-badge 
                            {{ $ktpStatus && $ktpStatus->status === 'APPROVED'
                                ? 'status-success'
                                : ($ktpStatus && $ktpStatus->status === 'REJECTED'
                                    ? 'status-rejected'
                                    : 'status-pending') }}">
                            {{ $ktpStatus ? $ktpStatus->status : 'PENDING' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Identity Document</td>
                    <td>
                        @php
                        $identityStatus = \App\Models\DocumentValidation::where('booking_id', $booking['id'])
                        ->where('document_type', 'identity_booking')
                        ->first();
                        @endphp
                        <span class="status-badge 
                            {{ $identityStatus && $identityStatus->status === 'APPROVED'
                                ? 'status-success'
                                : ($identityStatus && $identityStatus->status === 'REJECTED'
                                    ? 'status-rejected'
                                    : 'status-pending') }}">
                            {{ $identityStatus ? $identityStatus->status : 'PENDING' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Selfie Document</td>
                    <td>
                        @php
                        $selfieStatus = \App\Models\DocumentValidation::where('booking_id', $booking['id'])
                        ->where('document_type', 'selfie_booking')
                        ->first();
                        @endphp
                        <span class="status-badge 
                            {{ $selfieStatus && $selfieStatus->status === 'APPROVED'
                                ? 'status-success'
                                : ($selfieStatus && $selfieStatus->status === 'REJECTED'
                                    ? 'status-rejected'
                                    : 'status-pending') }}">
                            {{ $selfieStatus ? $selfieStatus->status : 'PENDING' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        <p><strong>Thank you for your booking!</strong></p>
        <p>For any inquiries, please contact our customer service at 088229877220</p>
        <p style="font-size: 10px; color: #999;">This is a computer-generated document and no signature is required.
        </p>
    </div>
</body>

</html>