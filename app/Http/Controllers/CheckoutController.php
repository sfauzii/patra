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

    public function store(Request $request, $slug) {

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
        $booking = Booking::findOrFail($bookingId);
        $booking->payment_method = $request->payment_method;

        if ($request->payment_method == 'midtrans') {

            // Get the total price from the booking
            $totalPrice = $booking->total_price;


            // Call Midtrans API
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
            \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

            // Get USD to IDR rate using guzzle
            // $client = new \GuzzleHttp\Client();
            // $response = $client->request('GET', 'https://api.exchangerate-api.com/v4/latest/USD');
            // $body = $response->getBody();
            // $rate = json_decode($body)->rates->IDR;

            // // Convert to IDR
            // $totalPrice = $booking->total_price * $rate;

            // Create Midtrans Params
            $midtransParams = [
                'transaction_details' => [
                    'order_id' => $booking->id,
                    'gross_amount' => (int) $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $booking->name,
                    'email' => auth()->user()->email,
                ],
                'enabled_payments' => ['gopay', 'bank_transfer'],
                'vtweb' => []
            ];

            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // Save payment URL to booking
            $booking->payment_url = $paymentUrl;
            $booking->save();

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }

        return redirect()->route('home');
    }   

    public function success(Request $request)
    {
        return view('success');
    }
}
