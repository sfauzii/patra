<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $booking = Booking::findOrFail($orderId);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $booking->payment_status = 'pending';
                } else {
                    $booking->payment_status = 'success';
                }
            }
        } elseif ($status == 'settlement') {
            $booking->payment_status = 'success';
        } elseif ($status == 'pending') {
            $booking->payment_status = 'pending';
        } elseif ($status == 'deny') {
            $booking->payment_status = 'cancelled';
        } elseif ($status == 'expire') {
            $booking->payment_status = 'cancelled';
        } elseif ($status == 'cancel') {
            $booking->payment_status = 'cancelled';
        }

        // Simpan transaksi
        $booking->save();

        // Return response
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success',
            ],
        ]);
    }

    public function finishRedirect(Request $request)
    {
        $orderId = $request->input('id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');

        // Ambil transaksi berdasarkan ID order
         $booking = Booking::where('id', $orderId)->first();
        //  $transaction = Transaction::where('id', $orderId)->first();

        // Jika pembayaran berhasil (status "settlement"), arahkan pengguna ke halaman success
        if ($statusCode == 200 && $transactionStatus == 'settlement') {
            return view('pages.redirect.success', [
                'booking' => $booking,
            ]);
        } else if ($statusCode == 201 && $transactionStatus == 'pending') {
            return view('pages.redirect.unfinish');
        } else {
            return view('pages.redirect.failed');
        }
    }

    public function unfinishRedirect(Request $request)
    {
        $orderId = $request->input('id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');

        // Jika pembayaran berhasil (status "settlement"), arahkan pengguna ke halaman success
        if ($statusCode == 201 && $transactionStatus == 'pending') {
            return view('pages.redirect.unfinish');
        }
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.redirect.failed');
    }
}
