<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CheckBookingForm extends Component
{

    use LivewireAlert;

    public $booking_code;
    public $phone;
    public $bookingDetails;

    protected $rules = [
        'booking_code' => 'required',
        'phone' => 'required',
    ];

    public function checkBooking()
    {
        $this->validate();

        $this->bookingDetails = Booking::with('item.type')
            ->where('booking_code', $this->booking_code)
            ->where('phone', $this->phone)
            ->where('user_id', Auth::id()) // Filter by the logged-in user's ID
            ->first();

        // Emit event to pass booking details to the BookingDetails component
        if ($this->bookingDetails) {
            $this->dispatch('bookingFound', $this->bookingDetails);
            $this->alert('success', 'Booking founded successfully');
        } else {
            $this->alert('error', 'Oppss', [
                'text' => 'Booking not found. Please check your booking code and phone number.',
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'position' => 'center',
                'timer' => null
            ]);
        }
    }

    public function render()
    {
        return view('livewire.check-booking-form');
    }
}
