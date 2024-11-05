<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Booking;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class Checkout extends Component
{

    use WithFileUploads;

    public $item;
    public $name;
    public $phone;
    public $address;
    public $startDate;
    public $endDate;
    public $ktpBooking;
    public $identityBooking;
    public $selfieBooking;
    public $uniqueCode;
    public $subTotal = 0;
    public $grandTotal = 0;
    public $bookingPrice;
    public $paymentService = 10000;

    protected $listeners = ['calculateTotal'];

    public function mount(Item $item)
    {
        $this->item = $item;
        $this->bookingPrice = $item->price;
        // $this->uniqueCode = rand(100, 999);

        // Check if unique code exists in session; if not, generate and store it
        if (!session()->has('unique_code')) {
            $this->uniqueCode = rand(100, 999);
            session(['unique_code' => $this->uniqueCode]);
        } else {
            $this->uniqueCode = session('unique_code');
        }

        // Load data from session if exists
        if (session()->has('booking_data')) {
            $data = session('booking_data');
            $this->name = $data['name'];
            $this->phone = $data['phone'];
            $this->address = $data['address'];
            $this->startDate = $data['start_date'];
            $this->endDate = $data['end_date'];
        }

        // Fetch the authenticated user's name
        if (auth()->check()) {
            $this->name = auth()->user()->name; // Get the user's name from the auth system
        } else {
            $this->name = ''; // No user logged in
        }
    }

    public function updated($propertyName)
    {
        $this->calculateTotal();
        $this->storeInSession();
    }

    public function calculateTotal()
    {
        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate);
            $end = Carbon::parse($this->endDate);
            $days = $start->diffInDays($end);

            // Calculate subtotal
            if ($start->isSameDay($end)) {
                // Same day discount applied
                $this->subTotal = $this->bookingPrice - 100; // Discounted price for same day
            } else {
                $days = $start->diffInDays($end);
                $this->subTotal = $this->bookingPrice * $days;
            }

            // Calculate grand total
            $this->grandTotal = $this->subTotal - $this->uniqueCode + $this->paymentService;
        }
    }

    private function storeInSession()
    {
        session(['booking_data' => [
            'item_id' => $this->item->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_price' => $this->grandTotal,
            'sub_total' => $this->subTotal,
            'unique_code' => $this->uniqueCode,
            'payment_service' => $this->paymentService
        ]]);
    }

    public function processPayment()
    {
        $this->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'ktpBooking' => 'required|image|max:2048',
            'identityBooking' => 'required|image|max:2048',
            'selfieBooking' => 'required|image|max:2048',
        ]);

        // Store files
        $ktpPath = $this->ktpBooking->store('uploads', 'public');
        $identityPath = $this->identityBooking ? $this->identityBooking->store('uploads', 'public') : null;
        $selfiePath = $this->selfieBooking ? $this->selfieBooking->store('uploads', 'public') : null;

        // Create booking in database
        $booking = Booking::create([
            'item_id' => $this->item->id,
            'user_id' => auth()->user()->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_price' => $this->grandTotal,
            'ktp_booking' => $ktpPath,
            'identity_booking' => $identityPath,
            'selfie_booking' => $selfiePath,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'payment_url' => ''
        ]);

        // Clear the unique code session after booking is completed
        session()->forget('unique_code');

        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        // Create Midtrans parameters
        $midtransParams = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => (int) $this->grandTotal,
            ],
            'customer_details' => [
                'first_name' => $this->name,
                'email' => auth()->user()->email,
                'phone' => $this->phone,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

            // Update booking with payment URL
            $booking->update(['payment_url' => $paymentUrl]);

            // Clear session after successful processing
            session()->forget('booking_data');

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (\Exception $e) {
            // Delete booking if payment URL generation fails
            $booking->delete();
            session()->flash('error', 'Payment processing failed. Please try again.');
            return null;
        }
    }
    public function render()
    {
        return view('livewire.checkout');
    }
}
