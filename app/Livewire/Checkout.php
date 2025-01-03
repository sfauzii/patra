<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Booking;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\DocumentValidation;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Checkout extends Component
{

    use WithFileUploads;
    use LivewireAlert;

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
    public $terms;

    protected $listeners = ['calculateTotal'];

    public $bookedDates = [];

    public function mount(Item $item)
    {
        $this->item = $item;
        $this->terms = false;
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

        // Load booked dates when component is mounted
        $this->loadBookedDates();
    }

    private function loadBookedDates()
    {
        $bookings = Booking::where('item_id', $this->item->id)
            ->where('payment_status', 'success')
            ->get();

        $bookedDates = [];

        foreach ($bookings as $booking) {
            // Skip jika item sudah dikembalikan sebelum end_date
            if ($booking->return_status === 'returned') {
                continue;
            }

            $start = Carbon::parse($booking->start_date);
            $end = Carbon::parse($booking->end_date);

            while ($start->lte($end)) {
                $bookedDates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        $this->bookedDates = array_unique($bookedDates);
    }

    public function getBookedDatesProperty()
    {
        return json_encode($this->bookedDates);
    }


    public function updated($propertyName)
    {

        if ($propertyName === 'startDate' || $propertyName === 'endDate') {
            // Validasi tanggal yang sudah dibooking
            $this->validateBookingDates();
        }

        $this->calculateTotal();
        $this->storeInSession();
    }

    private function validateBookingDates()
    {
        if (!$this->startDate || !$this->endDate) {
            return false;
        }

        $requestedStart = Carbon::parse($this->startDate);
        $requestedEnd = Carbon::parse($this->endDate);

        // Cek konflik dengan booking yang aktif atau belum dikembalikan
        $conflictingBooking = Booking::where('item_id', $this->item->id)
            ->where('payment_status', 'success')
            ->where(function ($query) {
                $query->whereNull('return_status')
                    ->orWhere('return_status', '!=', 'returned');
            })
            ->where(function ($query) use ($requestedStart, $requestedEnd) {
                $query->whereBetween('start_date', [$requestedStart, $requestedEnd])
                    ->orWhereBetween('end_date', [$requestedStart, $requestedEnd])
                    ->orWhere(function ($q) use ($requestedStart, $requestedEnd) {
                        $q->where('start_date', '<=', $requestedStart)
                            ->where('end_date', '>=', $requestedEnd);
                    });
            })
            ->exists();

        if ($conflictingBooking) {
            $this->startDate = null;
            $this->endDate = null;
            $this->alert('error', 'Tanggal Tidak Tersedia', [
                'text' => 'Maaf, terdapat tanggal yang sudah dibooking pada rentang yang dipilih.',
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'position' => 'center',
                'timer' => null
            ]);
            return false;
        }

        return true;
    }


    public function calculateTotal()
    {
        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate);
            $end = Carbon::parse($this->endDate);

            // Hitung jumlah hari
            // Tambahkan 1 untuk menghitung hari yang sama sebagai 2 hari
            $days = $start->diffInDays($end) + 1;

            // Hitung subtotal
            $this->subTotal = $this->bookingPrice * $days;



            // Hitung grand total
            $this->grandTotal = $this->subTotal + $this->paymentService - $this->uniqueCode;
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
        // Validasi ulang tanggal sebelum proses pembayaran
        $this->validateBookingDates();

        if (!$this->startDate || !$this->endDate) {
            $this->alert('error', 'Tanggal Invalid', [
                'text' => 'Silakan pilih tanggal yang tersedia.',
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'position' => 'center',
                'timer' => null
            ]);
            return;
        }

        // Cek apakah terms disetujui
        if (!$this->terms) {
            // session()->flash('error', 'Please accept the terms and conditions.');
            $this->alert('error', 'Oppss', [
                'text' => 'Mohon centang persetujuan Terms and Conditions sebelum melakukan checkout.',
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'position' => 'center',
                'timer' => null
            ]);
            return; // Hentikan eksekusi jika terms tidak disetujui
        }


        $this->validate([
            'name' => 'required|string',
            'phone' => 'required|string|min:10|regex:/^\d{10,}$/',
            'address' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'ktpBooking' => 'required|image|max:2048',
            'identityBooking' => 'required|image|max:2048',
            'selfieBooking' => 'required|image|max:2048',
            'terms' => 'accepted', // Menambahkan validasi untuk terms
        ]);

        // Store files
        $ktpPath = $this->ktpBooking->store('uploads', 'public');
        $identityPath = $this->identityBooking ? $this->identityBooking->store('uploads', 'public') : null;
        $selfiePath = $this->selfieBooking ? $this->selfieBooking->store('uploads', 'public') : null;





        // Generate booking_code with the format PTA + datetime + 3-digit random number
        $dateTime = now()->format('YmdHis'); // Format as YYYYMMDDHHMMSS
        $randomNumber = rand(100, 999); // Generate a random 3-digit number
        $bookingCode = 'PTA' . $dateTime . $randomNumber;

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
            'booking_code' => $bookingCode, // Add booking_code here
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'payment_url' => ''
        ]);


        // Clear the unique code session after booking is completed
        session()->forget('unique_code');

        // Step 6: Create document validation records for each document type with a status of 'PENDING'.
        $documentTypes = ['ktp_booking', 'identity_booking', 'selfie_booking'];

        foreach ($documentTypes as $documentType) {
            DocumentValidation::create([
                'booking_id' => $booking->id,
                'document_type' => $documentType,
                'status' => 'PENDING',
                'rejection_reason' => null,
            ]);
        }

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
