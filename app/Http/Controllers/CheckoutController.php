<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CheckoutController extends Controller
{
    public function index($slug)
    {

        $item = Item::with(['type', 'brand'])
            ->whereSlug($slug)
            ->firstOrFail();

        return view('checkout', [
            'item' => $item
        ]);
    }

    public function store(Request $request, $slug)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // Format start_date and end_date from dd mm yy to timestamp
        $start_date = Carbon::createFromFormat('d m Y', $request->start_date)->startOfDay();
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date)->endOfDay();

        // Count the number of days between start_date and end_date
        $days = $start_date->diffInDays($end_date);

        // Get the item
        $item = Item::whereSlug($slug)->firstOrFail();

        // Calculate the total price
        $total_price = $days * $item->price;

        // Add 10% tax
        // $total_price = $total_price * ($total_price * 0.1);
        $total_price = $total_price * (1 + 0.1);

        $booking = $item->bookings()->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'start_date' => Carbon::parse($start_date),
            'end_date' => Carbon::parse($end_date),
            'total_price' => $total_price,
        ]);
    }

    public function payment(Request $request, $bookingId)
    {
        // Retrieve booking data from session
        $bookingData = session('booking_data');
        $bookingFiles = session('booking_files');

        if (!$bookingData || !$bookingFiles) {
            return redirect()->route('checkout')->with('error', 'Please complete the booking form first');
        }

        // Create booking record
        $booking = Booking::create([
            'item_id' => $bookingData['item_id'],
            'user_id' => auth()->user()->id,
            'name' => $bookingData['name'],
            'phone' => $bookingData['phone'],
            'address' => $bookingData['address'],
            'start_date' => $bookingData['start_date'],
            'end_date' => $bookingData['end_date'],
            'total_price' => $bookingData['total_price'],
            'ktp_booking' => $bookingFiles['ktp_booking'],
            'identity_booking' => $bookingFiles['identity_booking'],
            'selfie_booking' => $bookingFiles['selfie_booking'],
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'payment_url' => '', // Initialize with empty string
        ]);

        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        // Create Midtrans parameters
        $midtransParams = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => (int) $bookingData['total_price'],
            ],
            'customer_details' => [
                'first_name' => $bookingData['name'],
                'email' => auth()->user()->email,
                'phone' => $bookingData['phone'],
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // Update booking with payment URL
            $booking->update(['payment_url' => $paymentUrl]);

            // Clear session data after successful processing
            session()->forget(['booking_data', 'booking_files']);

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (\Exception $e) {
            // Handle error
            $booking->delete(); // Remove the booking if payment URL generation fails
            return redirect()->route('checkout')->with('error', 'Payment processing failed. Please try again.');
        }
    }

    public function success(Request $request)
    {
        return view('success');
    }
}
